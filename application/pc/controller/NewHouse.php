<?php
namespace app\pc\controller;
use think\Controller;
use \think\Request;
use app\pc\model\SellingHouse as SellingHouseModel;
use app\pc\model\SellingHouseImg as SellingHouseImgModel;
use app\pc\model\Admin as AdminModel;
use think\Db;
class NewHouse extends BaseController
{
    public function index()
    {
        //标题
        $this->assign('title','新房详情页');

        //新房信息
        //获取新房id
        $id = input('get.id');
        //创建SellingHouse的model实例
        $newHouse = new SellingHouseModel;
        //创建SellingHouseImg的model实例
        $newHouseImg = new SellingHouseImgModel;
        //获取新房信息
        $data = $newHouse->findById($id);
        //新房售价
        $data['total_money'] = round($data['total_money']/10000,0);
        //新房图片
        $data['img'] = $newHouseImg->where(['selling_house_id'=>$id])->select();
        //创建admin的model实例
        $admin = new AdminModel;
        $data['info'] =  $admin->where(['id'=>$data['admin_id']])->find();
        //定义data模板变量，传输到模板视图中
        $this->assign('data',$data);

        //获取新房列表
        $newHouseList = $newHouse->getList(['type'=>2],'rand()',4);
        foreach($newHouseList as &$v){
            $v['total_money'] = round($v['total_money']/10000,0);
            $v['img'] = $newHouseImg->where(['selling_house_id'=>$v['id']])->order('id asc')->find()['filename'];
        }
        //定义newHouseList模板变量,传输到模板视图中
        $this->assign('newHouseList',$newHouseList);
        // 返回当前控制器对应的视图模板index.html
        return $this->fetch();
    }

}
