<?php
namespace app\pc\controller;
use think\Controller;
use \think\Request;
use app\pc\model\SellingHouse as SellingHouseModel;
use app\pc\model\SellingHouseImg as SellingHouseImgModel;
class SecondHandHouseList extends BaseController
{
    public function index()
    {
        //标题
        $this->assign('title','二手房列表页');

        //二手房列表
        //创建SellingHouse模板变量，传输到模板视图中
        $secondHandHouse = new SellingHouseModel;
        //创建SellingHouseImg模板变量，，传输到模板视图中
        $secondHandHouseImg = new SellingHouseImgModel;
        $where = array();
        $where['type'] = 1;
        $search = input('get.search');
        $where['title| name'] = array('like','%'.$search.'%');
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
        //获取二手房列表条数
        $count = count($secondHandHouse->getList($where));
        //定义count模板变量，传输到模板视图中
        $this->assign('count',$count);
        //获取二手房列表-随机取4  条
        $secondHandHouseList = $secondHandHouse->where($where)->paginate(4);
        foreach($secondHandHouseList as &$v){
            $v['total_money'] = round($v['total_money']/10000,0);
            $v['img'] = $secondHandHouseImg->where(['selling_house_id'=>$v['id']])->find()['filename'];
            $v['day'] = '';
            $v['day'] = round((time()-$v['add_time'])/(24*60*60),0);
            if($v['day']<30){
                $v['day'] = $v['day'].'天以前发布';
            }else{
                $v['day'] = round($v['day']/30,0).'个月以前发布';
            }
        }
        //定义secondHandHouseList模板变量，传输到模板视图中
        $this->assign('secondHandHouseList',$secondHandHouseList);

        //推荐房屋
        //获取二手房列表-随机取5条
        $list = $secondHandHouse->getList(['type'=>1],'rand()',5);
        foreach($list as &$v){
            $v['total_money'] = round($v['total_money']/10000,0);
            $v['img'] = $secondHandHouseImg->where(['selling_house_id'=>$v['id']])->find()['filename'];
        }
        //定义list模板变量,传输到模板视图中
        $this->assign('list',$list);
        // 返回当前控制器对应的视图模板index.html
        return $this->fetch();
    }

}
