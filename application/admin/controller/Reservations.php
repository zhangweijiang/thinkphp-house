<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Reservations as ReservationsModel;
use think\Db;
class Reservations extends BaseController
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
     * 预约看房列表
     */
   public function index(){
       $bread = array(
           '0' => array(
               'name' => '房屋管理',
               'url' => ''
           ),
           '1' => array(
               'name' => '预约看房列表',
               'url' => '/admin/reservations/index'
           )
       );
       $this->assign('breadhtml', $this->getBread($bread));
       $reservations = new ReservationsModel;
       $list = $reservations ->getList();
       $this->assign('list',$list);
       echo $this->fetch();
   }

    /**
     * 更改接单状态
     */
   public function updateStatus(){
       $id = input('post.id');
       $reservations = new ReservationsModel;
       $data = array();
       $data['status'] = 1;//0表示未处理,1表示已处理
       $re = $reservations->updateData($data,['id'=>$id]);
       if($re!==FALSE){
           ajaxReturn('','成功',1);
       }else{
           ajaxReturn('','失败',0);
       }
   }




    //刷新页面
    public function refresh(){
        $reservations = new ReservationsModel;
        $list = $reservations ->getList();
        $this->assign('list',$list);
        ajaxReturn($this->fetch('ajaxPage'),'刷新成功',1);
    }




}
