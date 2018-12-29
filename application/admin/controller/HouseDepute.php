<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\HouseDepute as HouseDeputeModel;
use think\Db;
class HouseDepute extends BaseController
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
     * 房屋委托列表
     */
   public function index(){
       $bread = array(
           '0' => array(
               'name' => '房屋管理',
               'url' => ''
           ),
           '1' => array(
               'name' => '房屋委托列表',
               'url' => '/admin/house_depute/index'
           )
       );
       $this->assign('breadhtml', $this->getBread($bread));
       //搜索条件
       $where = array();
       $where['take_id'] = array('in','0,'.$_SESSION['think']['admin']['id']);
       $username = input('get.username');
       $is_take = input('get.is_take')?input('get.is_take'):1;
       if($username){
           $where['username'] = array('like','%'.$username.'%');
           $this->assign('username',$username);
       }
       if($is_take){
           $where['is_take'] = $is_take;
           $this->assign('is_take',$is_take);
       }
       $houseDepute = new HouseDeputeModel;
       $list = $houseDepute->getList($where);
       $this->assign('list',$list);
       echo $this->fetch();
   }

    /**
     * 更改接单状态
     */
   public function updateTake(){
       $id = input('post.id');
       $houseDepute = new HouseDeputeModel;
       $data = array();
       $data['is_take'] = 2;//1表示未接单，2表示已接单
       $data['take_id'] = $_SESSION['think']['admin']['id'];
       $data['take_name'] = $_SESSION['think']['admin']['username'];
       $re = $houseDepute->updateData($data,['id'=>$id]);
       if($re!==FALSE){
           ajaxReturn('','接单成功',1);
       }else{
           ajaxReturn('','接单失败',0);
       }
   }




    //刷新页面
    public function refresh(){
        //搜索条件
        $where = array();
        $where['take_id'] = array('in','0,'.$_SESSION['think']['admin']['id']);
        $username = input('get.username');
        $is_take = input('get.is_take');
        if($username){
            $where['username'] = array('like','%'.$username.'%');
            $this->assign('username',$username);
        }
        if($is_take){
            $where['is_take'] = $is_take;
            $this->assign('is_take',$is_take);
        }
        $houseDepute = new HouseDeputeModel;
        $list = $houseDepute->getList($where);
        $this->assign('list',$list);
        ajaxReturn($this->fetch('ajaxPage'),'刷新成功',1);
    }




}
