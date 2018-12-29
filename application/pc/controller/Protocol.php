<?php
/**
 * 用户服务协议
 */
namespace app\pc\controller;
use think\Controller;
use \think\Request;
use think\Db;
class Protocol extends BaseController
{
    /**
     * 用户服务协议页面
     * @return mixed
     */
    public function index(){
        //标题
        $this->assign('title','用户服务协议');
        //获取用户服务协议内容
        $data = Db::name('protocol')->find();
        //定义data模板变量，传输到模板视图中
        $this->assign('data',$data);
        // 返回当前控制器对应的视图模板index.html
        return $this->fetch();
    }






}
