<?php
namespace app\pc\controller;
use app\pc\model\Reservations;
use think\Controller;
use \think\Request;
use app\pc\model\SellingHouse as SellingHouseModel;
use app\pc\model\SellingHouseImg as SellingHouseImgModel;
use app\pc\model\Admin as AdminModel;
use app\pc\model\Reservations as ReservationsModel;
use think\Db;
class SecondHandHouse extends BaseController
{
    public function index()
    {
        //标题
        $this->assign('title','二手房详情页');

        //二手房信息
        $id = input('get.id');
        //创建SellingHouse的model实例
        $secondHandHouse = new SellingHouseModel;
        //创建SellingHouseImg的model实例
        $secondHandHouseImg = new SellingHouseImgModel;
        //获取二手房信息
        $data = $secondHandHouse->findById($id);
        $data['total_money'] = round($data['total_money']/10000,0);
        $data['img'] = $secondHandHouseImg->where(['selling_house_id'=>$id])->select();
        //创建admin的model实例
        $admin = new AdminModel;
        //获取中介用户信息
        $data['info'] =  $admin->where(['id'=>$data['admin_id']])->find();
        //定义data模板变量，传输到模板视图中
        $this->assign('data',$data);


        //二手房列表
        //获取二手房列表-随机取4条
        $secondHandHouseList = $secondHandHouse->getList(['type'=>1],'rand()',4);
        foreach($secondHandHouseList as &$v){
            $v['total_money'] = round($v['total_money']/10000,0);
            $v['img'] = $secondHandHouseImg->where(['selling_house_id'=>$v['id']])->order('id asc')->find()['filename'];
        }
        //定义secondHandHouseList模板变量，传输到模板视图中
        $this->assign('secondHandHouseList',$secondHandHouseList);

        //是否预约
        //通过session获取用户id
        $user_id = session('user')['id'];
        $house_id = input('get.id');
        //创建Reservations的model实例
        $reservations= new ReservationsModel;
        //获取预约房源列表
        $reservationsInfo = $reservations->where(['house_id'=>$house_id,'user_id'=>$user_id])->find();
        if($reservationsInfo){
            $reservations_ok = 1;
        }else{
            $reservations_ok = 0;
        }
        //定义reservations_ok模板变量，传输到模板视图中
        $this->assign('reservations_ok',$reservations_ok);
        // 返回当前控制器对应的视图模板index.html
        return $this->fetch();
    }

    /**
     * 预约看房
     */
    public function subscribe(){
        if ($this->isLogin() === false) {
            session('url','/pc/second_hand_house/index'.'?id='.input('post.id'));
            ajaxReturn('','您还未登录，请登录',2);//未登录，进行登录
        }
        $sellingHouse = new SellingHouseModel;
        $reservations = new  ReservationsModel;
        $house_id = input('post.id');
        $user_id = session('user')['id'];
        $username = session('user')['username'];
        $tel = session('user')['tel'];
        //获取售房信息
        $sellingHouseInfo = $sellingHouse->findById($house_id);
        //预约看房插入的数组
        $data = array();
        $data['user_id'] = $user_id;
        $data['username'] = $username;
        $data['house_id'] = $house_id;
        $data['title'] = $sellingHouseInfo['title'];
        $data['name'] = $sellingHouseInfo['name'];
        $data['building_acreage'] = $sellingHouseInfo['building_acreage'];
        $data['money'] = $sellingHouseInfo['money'];
        $data['admin_id'] = $sellingHouseInfo['admin_id'];
        $data['tel'] = $tel;
        $data['add_time'] = time();
        $int = $reservations->addData($data);
        if($int){
            ajaxReturn($int,'预约成功',1);
        }else{
            ajaxReturn($int,'预约失败',0);
        }
    }

    /**
     * 取消预约看房
     */
    public function cancel_reservations(){
        if ($this->isLogin() === false) {
            session('url','/pc/second_hand_house/index'.'?id='.input('post.id'));
            ajaxReturn('','您还未登录，请登录',2);//未登录，进行登录
        }
        $reservations = new  ReservationsModel;
        $house_id = input('post.id');
        $user_id = session('user')['id'];
        $res = $reservations->where(['house_id'=>$house_id,'user_id'=>$user_id])->delete();
        if($res){
            ajaxReturn($res,'success',1);
        }else{
            ajaxReturn($res,'error',1);
        }

    }

}
