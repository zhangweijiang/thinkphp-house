<?php
namespace app\pc\controller;
use think\Controller;
use \think\Request;
use think\Db;
use app\pc\model\User as UserModel;
class User extends BaseController
{
    public function index(){
        $user = new UserModel;
        if ($this->isLogin() !== false) {//已登录-直接跳转到网站主页面
            $this->redirect('Pc/index/index');
        }
        return $this->fetch();
    }

    //注册
    public function register(){
        if(request()->isPost()){   //注册页面信息提交
            //创建user的model实例
            $user = new UserModel;
            $data = input('post.');
            $data['add_time'] = time();
            $userInfo = $user->where(array('username'=>$data['username']))->find();
            if($userInfo){
                $this->error('该用户已被注册，请重新申请');
            }
            $insert = array(
                'username' => $data['username'],
                'password' => md5($data['password']),
                'user_img' => '20180312/1.jpg'

            );
            //数据插入-注册
            $result = $user->addData($insert);
            if($result>0){ //$result为添加成功后返回的主键id，大于0表示添加成功
                header('content-type:text/html;charset=utf-8');
                echo "<script>
                            alert('恭喜您注册成功，请登录');
                            window.location.href = '/pc/user/index?type=2';
                      </script>";
            }
        }
    }
    //登录
    public function login(){
        //创建user的model实例
        $user = new UserModel;
        if(request()->isPost()){   //登录页面信息提交
            $data = input('post.');
            $password = input('post.password');
            $where = array(
                'username' => $data['username'],
            );
            //获取用户信息
            $userInfo = $user->where($where)->find();
            if($userInfo){ //用户存在
                if($userInfo['password']==md5($password)){
                    if($userInfo['status']==1){  //0表示禁用,表示启用
                        session('user',$userInfo->toArray());
                        if(session('url')){
                            $this->redirect(session('url'));
                        }else{
                            $this->redirect('Pc/Index/index');//跳转到首页
                        }
                    }else{
                        $this->error('该用户已被禁用，请联系平台！');
                    }
                }else{
                    $this->error('您输入的密码不正确，请重新输入！');
                }
            }else{ //用户不存在
                $this->error('用户不存在！');
            }
        }
    }

    /**
     * 忘记密码
     */
    public function forget(){
        if (request()->isPost()) {
            //创建user的model实例
            $user = new UserModel;
            $result = $user->where('email', $_POST["email"])->find();

            if ($result) {
                //随机生成8位书的密码
                $code = generate_password(8);
                $toemail = $_POST["email"];
                $subject = "房屋中介管理系统【忘记密码】邮件";
                $body = "您好，我们已对您在房屋中介网站上对应邮箱帐号的密码进行重置，重置的密码为：" . $code . "。请及时登录修改密码！";
                if ($this->send_email($toemail, $subject, $body)) {
                    //账号密码的更新
                    $res = Db::name('user')->where('username', $result["username"])->update(['password'=>md5($code)]);
                    if ($res) {
                        $msg = "重置密码成功！";
                        ajaxReturn('',$msg,1);
                    } else {
                        $msg = "重置密码失败！";
                        ajaxReturn('',$msg,0);
                    }

                } else {
                    $msg = "邮件发送失败！";
                    ajaxReturn('',$msg,0);
                }

            } else {
                $msg = "该邮箱帐号不存在，请重新输入！";
                ajaxReturn('',$msg,0);
            }
        }
    }




}
