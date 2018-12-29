<?php
namespace app\pc\controller;
use think\Controller;
use \think\Request;
use app\pc\model\House as HouseModel;
use app\pc\model\HouseImg as HouseImgModel;
class RentHouseList extends BaseController
{
    public function index()
    {
        //标题
        $this->assign('title','租房列表页');
        //二手房列表
        //创建house的model实例
        $House = new HouseModel;
        //创建houseImg的model实例
        $HouseImg = new HouseImgModel;
        $where = array();
        $search = input('get.search');
        $where['title| name'] = array('like','%'.$search.'%');
        $money = input('get.money');
        $building_acreage = input('get.acreage');
        $decoration = input('get.decoration');
        //租金
        if($money){
            switch ($money){
                case 1:
                    $where['money'] = array('lt',1500);
                    break;
                case 2:
                    $where['money'] = array('between','1500,2000');
                    break;
                case 3:
                    $where['money'] = array('between','2000,2500');
                    break;
                case 4:
                    $where['money'] = array('between','2500，3000');
                    break;
                case 5:
                    $where['money'] = array('between',',3000,3500');
                    break;
                case 6:
                    $where['money'] = array('between','3500,4000');
                    break;
                default :
                    $where['money'] = array('gt','4000');
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
                    $where['acreage'] = array('lt',20);
                    break;
                case 2:
                    $where['acreage'] = array('between','20,40');
                    break;
                case 3:
                    $where['acreage'] = array('between','40,60');
                    break;
                case 4:
                    $where['acreage'] = array('between','60,100');
                    break;
                case 5:
                    $where['acreage'] = array('gt',100);
                    break;
            }
        }
        //统计搜索到有多少条房子
        $count = count($House->getList($where));
        //定义count模板变量，传输到模板视图中
        $this->assign('count',$count);
        $HouseList = $House->where($where)->paginate(4);//分页4条一页
        foreach($HouseList as &$v){
            $v['img'] = $HouseImg->where(['house_id'=>$v['id']])->find()['filename'];
            $v['day'] = '';
            $v['day'] = round((time()-$v['add_time'])/(24*60*60),0);
            if($v['day']<30){
                $v['day'] = $v['day'].'天以前发布';
            }else{
                $v['day'] = round($v['day']/30,0).'个月以前发布';
            }
        }
        //定义HouseList模板变量，传输到模板视图中
        $this->assign('HouseList',$HouseList);

        //推荐房屋
        //获取租房列表-随机取5条
        $list = $House->getList([],'rand()',5);
        foreach($list as &$v){
            $v['img'] = $HouseImg->where(['house_id'=>$v['id']])->find()['filename'];
        }
        //定义list模板变量，传输到模板视图中
        $this->assign('list',$list);
        // 返回当前控制器对应的视图模板index.html
        return $this->fetch();
    }

}
