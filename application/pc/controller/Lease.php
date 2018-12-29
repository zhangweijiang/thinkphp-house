<?php
/**
 * 业主委托
 */
namespace app\pc\controller;
use think\Controller;
use \think\Request;
use app\pc\model\HouseDepute as HouseDeputeModel;
class Lease extends BaseController
{
    /**
     * 业主委托页面
     * @return mixed
     */
    public function index()
    {
        // 返回当前控制器对应的视图模板index.html
        if ($this->isLogin() === false) {
            session('url','/pc/lease/index');
            $this->redirect('pc/user/index?type=2');
        }
        return $this->fetch();
    }

    /**
     * 业主委托表单信息提交
     */
    public function save(){
        //获取前台post的表单数据
        $data = input('post.');
        $data['add_time'] = time();//添加时间
        //创建HouseDepute的model实例
        $houseDepute = new HouseDeputeModel;
        //数据保存
        $res = $houseDepute->addData($data);
        if($res){ //成功
            ajaxReturn($res,'success',1);
        }else{ //失败
            ajaxReturn($res,'error',0);
        }
    }

}
