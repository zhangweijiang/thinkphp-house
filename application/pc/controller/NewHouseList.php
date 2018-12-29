<?php
namespace app\pc\controller;
use think\Controller;
use \think\Request;
use app\pc\model\SellingHouse as SellingHouseModel;
use app\pc\model\SellingHouseImg as SellingHouseImgModel;
class NewHouseList extends BaseController
{
    public function index()
    {
        //标题
        $this->assign('title','新房列表页');

        //创建SellingHouse的model实例
        $newHouse = new SellingHouseModel;
        //创建SellingHouseImg的model实例
        $newHouseImg = new SellingHouseImgModel;
        $where = array();
        $where['type'] = 2; //1表示二手房,2表示新房
        $money = input('get.money');
        $building_acreage = input('get.acreage');
        $decoration = input('get.decoration');
        //价格
        if($money){
            switch ($money){
                case 1:
                    $where['total_money'] = array('lt',1000000);
                    break;
                case 2:
                    $where['total_money'] = array('between','1000000,2000000');
                    break;
                case 3:
                    $where['total_money'] = array('between','2000000,4000000');
                    break;
                case 4:
                    $where['total_money'] = array('between','4000000,6000000');
                    break;
                case 5:
                    $where['total_money'] = array('between','6000000,8000000');
                    break;
                case 6:
                    $where['total_money'] = array('between','8000000,10000000');
                    break;
                default :
                    $where['total_money'] = array('gt','10000000');
                    break;
            }
        }
        //装修情况
        if($decoration){
            $where['decoration'] = $decoration;
        }
        //建筑面积
        if($building_acreage){
            switch ($building_acreage){
                case 1:
                    $where['building_acreage'] = array('lt',50);
                    break;
                case 2:
                    $where['building_acreage'] = array('between','50,100');
                    break;
                case 3:
                    $where['building_acreage'] = array('between','100,500');
                    break;
                case 4:
                    $where['building_acreage'] = array('between','150,200');
                    break;
                case 5:
                    $where['building_acreage'] = array('gt',200);
                    break;
            }
        }
        $search = input('get.search');
        $where['title| name'] = array('like','%'.$search.'%');
        //获取新房列表
        $newHouseList = $newHouse->getList($where);
        foreach($newHouseList as &$v){
            //售价
            $v['total_money'] = round($v['total_money']/10000,0);
            //图片
            $v['img'] = $newHouseImg->where(['selling_house_id'=>$v['id']])->find()['filename'];
            $v['day'] = '';
            //发布多少天了
            $v['day'] = round((time()-$v['add_time'])/(24*60*60),0);
            if($v['day']<30){
                $v['day'] = $v['day'].'天以前发布';
            }else{
                $v['day'] = round($v['day']/30,0).'个月以前发布';
            }
        }
        //定义newHouseList模板变量，传输到模板视图中
        $this->assign('newHouseList',$newHouseList);

        //推荐房屋
        //随机取新房的5条数据信息
        $list = $newHouse->getList(['type'=>2],'rand()',5);
        foreach($list as &$v){
            //售价
            $v['total_money'] = round($v['total_money']/10000,0);
            //图片
            $v['img'] = $newHouseImg->where(['selling_house_id'=>$v['id']])->find()['filename'];
        }
        //定义list模板变量，传输到模板视图中
        $this->assign('list',$list);
        // 返回当前控制器对应的视图模板index.html
        return $this->fetch();
    }

}
