<?php
namespace app\pc\controller;
use think\Controller;
use \think\Request;
use app\pc\model\User as UserModel;
class Personal extends BaseController
{
    /**
     * 个人信息列表
     * @return mixed
     */
    public function index()
    {
        //标题
        $this->assign('title','个人信息');
        if ($this->isLogin() === false) {//已登录-直接跳转到网站主页面
            session('url','/pc/personal/index');
            $this->redirect('pc/user/index?type=2');
        }
        //通过session获取用户id
        $user_id = session('user')['id'];
        //创建user的model实例
        $user = new UserModel();
        //获取用户基本信息
        $data = $user->findById($user_id);
        //定义data模板变量，传输到模板视图中
        $this->assign('data',$data);
        // 返回当前控制器对应的视图模板index.html
        return $this->fetch();
    }

    /**
     * 头像保存
     */
    public function imgsave(){
        //创建user的model实例
        $user = new UserModel;
        //通过session获取用户id
        $user_id = session('user')['id'];
        //删除旧时图片
        $userInfo = $user->findById($user_id);
        //删除旧图片
        deleteFile(ROOT_PATH . 'public' . DS . 'upload'. DS.$userInfo['user_img']);
        $where = array('id'=>$user_id);
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('user_img');

        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload');
            if($info){
                // 成功上传后 获取上传信息;
                // 输出 20171224/42a79759f284b767dfcb2a0197904287.jpg
                $data['user_img'] =  $info->getSaveName();
            }else{
                // 上传失败获取错误信息
                ajaxReturn('','图片上传失败',1);
            }
        }
        //更新头像
        $re = $user->updateData($data,$where);
        if($re!==FALSE){
            ajaxReturn('','上传成功',1);
        }else{
            ajaxReturn('','上传失败',0);
        }
    }

    /**
     * 个人信息保存
     */
    public function save(){
        //获取前台post过来的表单数据
        $data = input('post.');
        //创建user的model实例
        $user = new UserModel;
        //通过session获取用户id
        $user_id = session('user')['id'];
        $where = array('id'=>$user_id);
        //更新数据
        $re = $user->updateData($data,$where);
        if($re!==FALSE){
            ajaxReturn('','修改成功',1);
        }else{
            ajaxReturn('','修改失败',0);
        }
    }

    //密码修改
    public function savepwd(){
        $password = input('post.password'); //旧密码
        $password1 = input('post.password1'); //新密码
        $user = new UserModel;
        $user_id = session('user')['id'];
        $where = array('id'=>$user_id);
        $userInfo = $user->findById($user_id);
        if($userInfo['password']!= md5($password)){
            ajaxReturn('','您输入的旧密码不正确，修改失败',0);
        }else{
            $data['password'] = md5($password1);
            $re = $user->updateData($data,$where);
            if($re!==FALSE){
                ajaxReturn('','修改成功',1);
            }else{
                ajaxReturn('','修改失败',0);
            }
        }
    }

}
