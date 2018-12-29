<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin as AdminModel;
use app\admin\validate\Login as LoginValidate;
class Login extends Controller
{
    /**
     * 登录页面
     * @return mixed
     */
    public function index()
    {
        if (request()->isPost()) {
            $validate = new LoginValidate;
            $admin = new AdminModel;
            $result = $validate->batch()->check(input('post.'));
            //保存用户名
            $this->assign('username',input('post.username'));
            //对用户登录数据进行校验
            if ($result === false) {//数据错误,输出错误信息
                $this->assign('validate', $validate->getError());
            } else {
                $uid = $admin->login($_POST['username'], input('post.password'));
                if ($uid > 0) { //登录成功
                    $this->redirect('Index/index'); //跳转至网站主页面
                } else {
                    switch ($uid) {
                        case -1:
                            $error = '用户不存在！';
                            break; //系统级别禁用
                        case -2:
                            $error = '密码错误！';
                            break;
                        case -3:
                            $error = '该用户被禁用！';
                            break;
                        default:
                            $error = '未知错误！';
                            break;
                    }
                    $this->assign("error", $error);
                }
            }
        }
        return $this->fetch();
    }

    /**
     * 退出登录
     */
    public function logout(){
        session('admin',null);
        session('admin_sign',null);
        $this->redirect('Login/index');
    }


    /**
     * sha256测试
     */
    public function sha256(){
        echo sha256('xjc2017');
    }


}
