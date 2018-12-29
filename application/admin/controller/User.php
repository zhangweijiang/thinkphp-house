<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User as UserModel;
class User extends BaseController
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
     * 普通用户列表
     */
   public function index(){
       $bread = array(
           '0' => array(
               'name' => '用户管理',
               'url' => ''
           ),
           '1' => array(
               'name' => '普通用户列表',
               'url' => '/admin/user/index'
           )
       );
       $this->assign('breadhtml', $this->getBread($bread));
       //搜索条件
       $where = array();
       $username = input('get.username');
       if($username){
           $where['username'] = array('like','%'.$username.'%');
           $this->assign('username',$username);
       }
       $user = new UserModel;
       $list = $user->getList($where);
       $this->assign('list',$list);

       echo $this->fetch();
   }

    /**
     * 通过主键id删除数据
     */
   public function delete(){
       $id = input('post.id');
       $user = new UserModel;
       $re = $user->deleteById($id);
       if($re){
           ajaxReturn('','删除成功',1);
       }else{
           ajaxReturn('','删除失败',0);
       }
   }

   /**
    * 通过主键id更新status状态
    */
    public function updateStatus(){
        $id = input('post.id');
        $status = input('post.status');
        $user = new UserModel;
        $data = ['status'=>$status];
        $where = ['id'=>$id];
        $re = $user->updateData($data,$where);

        //搜索条件
        $where = array();
        $username = input('get.username');
        if($username){
            $where['username'] = array('like','%'.$username.'%');
            $this->assign('username',$username);
        }
        $user = new UserModel;
        $list = $user->getList($where);
        $this->assign('list',$list);

        if($re !== FALSE){
            ajaxReturn($this->fetch('ajaxPage'),'更新成功',1);
        }else{
            ajaxReturn('','更新失败',0);
        }
    }

    //刷新页面
    public function refresh(){
        //搜索条件
        $where = array();
        $username = input('get.username');
        if($username){
            $where['username'] = array('like','%'.$username.'%');
            $this->assign('username',$username);
        }
        $user = new UserModel;
        $list = $user->getList($where);
        $this->assign('list',$list);
        ajaxReturn($this->fetch('ajaxPage'),'刷新成功',1);
    }

}
