<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\House as HouseModel;
use app\admin\model\HouseImg as HouseImgModel;
use app\admin\model\HouseConfig as HouseConfigModel;
class HouseCheck extends BaseController
{
    /**
     * 初始化判断是否有访问该控制器权限
     */
    public function _initialize(){
        $oath = strtolower(request()->controller());
        session_start();
        $oathArr = $_SESSION['oath'];
        if(!in_array($oath,$oathArr)){
            exit('很抱歉，您没有该访问权限!');
        }
    }
    /**
     * 房屋列表
     */
   public function index(){
       $bread = array(
           '0' => array(
               'name' => '房屋管理',
               'url' => ''
           ),
           '1' => array(
               'name' => '房屋审核列表',
               'url' => '/admin/house_check/index'
           )
       );
       $this->assign('breadhtml', $this->getBread($bread));
       $this->search();
       echo $this->fetch();
   }


   /**
    * 审核房屋的发布
    * 通过主键id更新status状态
    */
    public function updateStatus(){
        $id = input('post.id');
        $status = input('post.status');
        $house = new HouseModel;
        $data = ['status'=>$status];
        $where = ['id'=>$id];
        $re = $house->updateData($data,$where);
        $this->search();
        if($re !== FALSE){
            ajaxReturn($this->fetch('ajaxPage'),'审核成功',1);
        }else{
            ajaxReturn('','审核失败',0);
        }
    }

    //刷新页面
    public function refresh(){
        $this->search();
        ajaxReturn($this->fetch('ajaxPage'),'刷新成功',1);
    }

    public function search(){
        //搜索条件
        $where = array();
        $title = input('get.title');
        if($title){
            $where['title'] = array('like','%'.$title.'%');
            $this->assign('title',$title);
        }
        $house = new HouseModel;
        $list = $house->getList($where);
        $houseImg = new HouseImgModel;
        $houseConfig = new HouseConfigModel;
        if($list){
            foreach($list as &$v){
                $house_img = array();
                $house_img = $houseImg->getList(['house_id'=>$v['id']]);
                $v['house_img'] = $house_img;
                /*$config = explode(',',$v['config']);
                $house_config = array();
                foreach($config as $vv){
                    $house_config[] = $houseConfig->findById($vv)['name'];
                }
                $house_config = implode(',',$house_config);
                $v['config'] = $house_config;*/
            }
        }
        $this->assign('list',$list);
    }

    //获取房屋图片
    public function houseImg(){
        $this->search();
        $id = input('post.id');
        $house = new HouseModel;
        $houseInfo = $house->findById($id);
        $houseImg = new HouseImgModel;
        $houseImgList = $houseImg->getList(['house_id'=>$houseInfo['id']]);
        $this->assign('houseImgList',$houseImgList);
        if($houseImgList){
            ajaxReturn($this->fetch('houseImgAjax'),'更新成功',1);
        }else{
            ajaxReturn('','更新失败',0);
        }
    }






}
