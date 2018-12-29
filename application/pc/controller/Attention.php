<?php
/**
 * 关注房源
 */
namespace app\pc\controller;
use think\Controller;
use \think\Request;
use app\pc\model\Attention as AttentionModel;
use app\pc\model\House as HouseModel;
use app\pc\model\HouseImg as HouseImgModel;
use app\pc\model\User as UserModel;
class Attention extends BaseController
{
    /**
     * 关注的房源
     * @return mixed
     */
    public function index()
    {
        //创建attention的model实例
        $attention = new AttentionModel;
        //创建house的model实例
        $house = new HouseModel;
        //创建house_img的model实例
        $houseImg = new HouseImgModel;
        //通过$_SESSION获取用户id
        $user_id = session('user')['id'];
        //获取关注房源列表，分页每4条一页
        $attentionList = $attention->where(['user_id'=>$user_id])->paginate(4);
        foreach($attentionList as $v){
            $v['info'] = $house->where(['id'=>$v['house_id']])->find();
            $v['info']['img'] = $houseImg->where(['house_id'=>$v['house_id']])->find()['filename'];
        }
        //定义attentionList的模板变量，传输到模板视图中
        $this->assign('attentionList',$attentionList);

        //创建user的model实例
        $user = new UserModel();
        //获取用户基本信息
        $data = $user->findById($user_id);
        //定义data模板变量，传输到模板视图中
        $this->assign('data',$data);

        // 返回当前控制器对应的视图模板index.html
        return $this->fetch();
    }



}
