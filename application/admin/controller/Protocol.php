<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Protocol extends BaseController
{
    /**
     * 初始化判断是否有访问该控制器权限
     */
    public function _initialize(){
       /* $oath = strtolower(request()->controller());
        session_start();
        $oathArr = $_SESSION['oath'];
        if(!in_array($oath,$oathArr)){
            exit('很抱歉，您没有该访问权限!');
        }*/
    }

    public function index(){
        $bread = array(
            '0' => array(
                'name' => '用户服务协议',
                'url' => '/admin/protocol/index'
            ),
        );
        $this->assign('breadhtml', $this->getBread($bread));
        //处理编辑界面
        $data = Db::name('protocol')->find();
        $this->assign('data',$data);
        echo $this->fetch();
    }

    public function save(){
        $id = input('post.id');
        $content = input('post.content');
        $re = Db::name('protocol')->where(['id'=>$id])->update(['content'=>$content]);
        if($re!==FALSE){
            ajaxReturn($re,'success',1);
        }else{
            ajaxReturn($re,'error',0);
        }
    }

}
