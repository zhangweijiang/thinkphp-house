<?php
/**
 * 中介用户注册
 */
namespace app\pc\controller;
use think\Controller;
use think\Request;
use app\pc\model\Admin as AdminModel;
class Agency extends BaseController
{
    /**
     * 中介用户注册页面
     * @return mixed
     */
    public function index(){
        return $this->fetch();
    }

    /**
     *注册页面信息提交
     */
    public function register(){
        if(request()->isPost()){    //判断是否post提交
            //创建admin的model实例
            $admin = new AdminModel;
            //获取表单post提交的数据
            $data = input('post.');
            //获取中介用户信息
            $adminInfo = $admin->where(array('username'=>$data['username'],'type'=>1))->find();
            if($adminInfo){
                $this->error('该用户已被注册，请重新申请');
            }
            $insert = array(
                'username' => $data['username'],
                'password' => sha256($data['password']),
                'add_time' => time(),
                'user_img' => '20180312/1.jpg'
            );
            //中介用户插入数据，注册
            $result = $admin->addData($insert);
            if($result>0){ //$result为添加成功后返回的主键id，大于0表示添加成功
                header('content-type:text/html;charset=utf-8');
                echo "<script>
                            alert('恭喜您注册成功，请登录');
                            window.location.href = '/admin/login/index';
                      </script>";
            }
        }
    }


}
