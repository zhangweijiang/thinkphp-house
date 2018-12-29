<?php
namespace app\pc\controller;
use think\Controller;
use \think\Request;
use app\pc\model\House as HouseModel;
use app\pc\model\HouseImg as HouseImgModel;
use app\pc\model\Admin as AdminModel;
use app\pc\model\HouseConfig as HouseConfigModel;
use app\pc\model\Attention as AttentionModel;
use think\Db;
class RentHouse extends BaseController
{
    public function index()
    {
        //标题
        $this->assign('title','租房详情页');

        //二手房信息
        //获取租房id
        $id = input('get.id');
        //创建house的model实例
        $house = new houseModel;
        //创建houseImg的model实例
        $houseImg = new HouseImgModel;
        //获取房子基本信息
        $data = $house->findById($id);
        $data['day'] = round((time()-$data['add_time'])/(24*60*60),0);
        if($data['day']<30){
            $data['day'] = $data['day'].'天以前发布';
        }else{
            $data['day'] = round($data['day']/30,0).'个月以前发布';
        }
        //获取租房列表
        $data['img'] = $houseImg->where(['house_id'=>$id])->select();
        //创建admin的model实例
        $admin = new AdminModel;
        //获取中介用户信息
        $data['info'] =  $admin->where(['id'=>$data['admin_id']])->find();

        //房屋配置
        //创建HouseConfig的model实例
        $houseConfig = new HouseConfigModel;
        $data['config'] = explode(',',$data['config']);
        $configs = array();
        foreach($data['config'] as $c){
            $configs[] = $houseConfig->findById($c);
        }
        $data['configs'] = $configs;
        //定义data模板变量，传输到模板视图中
        $this->assign('data',$data);

        //二手房列表
        //创建house的model实例
        $house = new HouseModel;
        //创建houseImg的model实例
        $houseImg = new HouseImgModel;
        //随机获取租房列表-取4条
        $houseList = $house->getList([],'rand()',4);
        foreach($houseList as &$v){
            $v['img'] = $houseImg->where(['house_id'=>$v['id']])->order('id asc')->find()['filename'];
        }
        //定义houseList模板变量，传输到模板视图中
        $this->assign('houseList',$houseList);

        //是否关注
        //通过session获取用户id
        $user_id = session('user')['id'];
        $house_id = input('get.id');
        //创建attention的model实例
        $attention = new AttentionModel;
        //获取关注房子信息
        $attentionInfo = $attention->where(['house_id'=>$house_id,'user_id'=>$user_id])->find();
        if($attentionInfo){
            $attention_ok = 1;
        }else{
            $attention_ok = 0;
        }
        //定义attention_ok模板变量，传输到模板视图中
        $this->assign('attention_ok',$attention_ok);
        // 返回当前控制器对应的视图模板index.html
        return $this->fetch();
    }

    //关注
    public function attention(){
        if ($this->isLogin() === false) {//已登录-直接跳转到网站主页面
            session('url','/pc/rent_house/index'.'?id='.input('post.id'));
            ajaxReturn('','您还未登录，请登录',2);//未登录，进行登录
        }

        $attention = new AttentionModel;
        $house = new HouseModel;
        $house_id = input('post.id');
        $data = array();
        $data['add_time'] = time();
        $data['house_id'] = $house_id;
        $data['user_id'] = session('user')['id'];
        $res = $attention->addData($data);
        $house->where(['id'=>$house_id])->setInc('attention',1);
        if($res){
            $house->where(['id'=>$house_id])->setInc('attention','1');
            ajaxReturn($res,'关注成功',1);
        }else{
            ajaxReturn($res,'关注失败',0);
        }
    }

    //取消关注
    public function cancel_attention(){
        if ($this->isLogin() === false) {//已登录-直接跳转到网站主页面
            session('url','/pc/rent_house/index'.'?id='.input('post.id'));
            ajaxReturn('','您还未登录，请登录',2);//未登录，进行登录
        }
        $attention = new AttentionModel;
        $house = new HouseModel;
        $house_id = input('post.id');
        $user_id = session('user')['id'];
        $res = $attention->where(['house_id'=>$house_id,'user_id'=>$user_id])->delete();
        $house->where(['id'=>$house_id])->setDec('attention',1);
        if($res!=FALSE){
            $house->where(['id'=>$house_id])->setDec('attention','1');
            ajaxReturn($res,'success',1);
        }else{
            ajaxReturn($res,'error',0);
        }
    }

}
