<?php
namespace app\pc\controller;
use think\Controller;
use \think\Request;
use app\pc\model\House as HouseModel;
use app\pc\model\HouseImg as HouseImgModel;
use app\pc\model\SellingHouse as SellingHouseModel;
use app\pc\model\SellingHouseImg as SellingHouseImgModel;
class Index extends BaseController
{
    public function index()
    {

        //创建SellingHouse的model实例
        $secondHandHouse = new SellingHouseModel;
        //创建SellingHouseImg的model实例
        $secondHandHouseImg = new SellingHouseImgModel;
        //获取二手房列表-取4条
        $secondHandHouseList = $secondHandHouse->getList(['type'=>1],'rand()',4);
        foreach($secondHandHouseList as &$v){
            $v['total_money'] = round($v['total_money']/10000,0);
            $v['img'] = $secondHandHouseImg->where(['selling_house_id'=>$v['id']])->order('id asc')->find()['filename'];
        }
        //定义secondHandHouseList模板变量，传输到模板视图中
        $this->assign('secondHandHouseList',$secondHandHouseList);

        //创建SellingHouse的model实例
        $newHouse = new SellingHouseModel;
        //创建SelliingHouseImg的model实例
        $newHouseImg = new SellingHouseImgModel;
        //获取新房类表-取3条
        $newHouseList = $newHouse->getList(['type'=>2],'rand()',3);
        foreach($newHouseList as &$v1){
            //房屋总价
            $v1['total_money'] = round($v1['total_money']/10000,0);
            //房子图片
            $v1['img'] = $newHouseImg->where(['selling_house_id'=>$v1['id']])->order('id asc')->find()['filename'];
        }
        //定义newHouseList模板变量，传输到模板视图中
        $this->assign('newHouseList',$newHouseList);

        //创建House的model实例
        $house = new HouseModel;
        //创建HouseImg的模板实例
        $houseImg = new HouseImgModel;
        //获取租房列表
        $houseList = $house->getList([],'rand()',5);
        foreach($houseList as &$vv){
            //房子图片
            $v['img'] = $houseImg->where(['house_id'=>$vv['id']])->find()['filename'];
        }
        //定义houseList模板变量，传输到模板视图中
        $this->assign('houseList',$houseList);
        // 返回当前控制器对应的视图模板index.html
        return $this->fetch();
    }

    public function test(){
        echo sha256('admin888');
    }

}
