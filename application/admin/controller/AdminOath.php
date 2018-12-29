<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\AdminOath as AdminOathModel;
class AdminOath extends BaseController
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
     * 权限列表
     */
   public function index(){
       $bread = array(
           '0' => array(
               'name' => '权限管理',
               'url' => ''
           ),
           '1' => array(
               'name' => '权限列表',
               'url' => '/admin/admin_oath/index'
           )
       );
       $this->assign('breadhtml', $this->getBread($bread));
       //搜索条件
       $where = array();
       $type = input('get.type');
       if($type){
           $where['type'] = $type;
           $this->assign('type',$type);
       }
       //定义AdminOath的model实例
       $adminOath = new AdminOathModel;
       //获取用户权限类表
       $list = $adminOath->getList($where);
       //定义list的模板变量，传输到模板视图中
       $this->assign('list',$list);
       // 返回当前控制器对应的视图模板index.html
       echo $this->fetch();
   }

    /**
     * 通过主键id删除数据
     */
   public function delete(){
       $id = input('post.id');
       //创建AdminOath的model实例
       $adminOath = new AdminOathModel;
       //删除数据
       $re = $adminOath->deleteById($id);
       if($re){
           ajaxReturn('','删除成功',1);
       }else{
           ajaxReturn('','删除失败',0);
       }
   }

    /**
     * 权限添加和编辑页面
     */
   public function set(){
       $id = input('get.id');
       $bread = array(
           '0' => array(
               'name' => '权限管理',
               'url' => ''
           ),
           '1' => array(
               'name' => '权限列表',
               'url' => '/admin/admin_oath/index'
           ),
           '2' => array(
               'name' => '权限设置',
               'url' => '/admin/admin_oath/set?id='.$id
           )
       );
       $this->assign('breadhtml', $this->getBread($bread));
       //处理编辑界面
       if ($id) {
           //创建AdminOath的model实例
           $adminOath = new AdminOathModel;
           //获取权限信息
           $data = $adminOath->findById($id);
           //定义data模板变量，传输到模板视图中
           $this->assign('data', $data);
       }
       // 返回当前控制器对应的视图模板index.html
       echo $this->fetch();
   }

    /**
     * 添加和编辑的保存
     */
    public function save(){
        //创建AdminOath的model实例
        $adminOath = new AdminOathModel;
        $id = input('post.id');
        $data = input('post.');
        if (request()->isPost()) {

            $data = input('post.');
            if($id){  //编辑的保存
                $where = array('id'=>$id);
                //更新数据
                $re = $adminOath->updateData($data,$where);
                if($re!==FALSE){
                    ajaxReturn('','保存成功',1);
                }else{
                    ajaxReturn('','保存失败',1);
                }
            }else{  //添加的保存
                $data['add_time'] = time();
                //插入数据
                $re = $adminOath->addData($data);
                if($re>0){
                    ajaxReturn('','保存成功',1);
                }else{
                    ajaxReturn('','保存失败',1);
                }
            }
        }
    }

    //刷新页面
    public function refresh(){
        //搜索条件
        $where = array();
        $type = input('get.type');
        if($type){
            $where['type'] = $type;
            $this->assign('type',$type);
        }
        //创建adminOath的model实例
        $adminOath = new AdminOathModel;
        //获取权限列表
        $list = $adminOath->getList($where);
        //定义list模板变量，传输到模板视图中
        $this->assign('list',$list);
        ajaxReturn($this->fetch('ajaxPage'),'刷新成功',1);
    }


}
