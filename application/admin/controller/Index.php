<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\HouseDepute as HouseDeputeModel;
use think\Db;
class Index extends BaseController
{
    public function index()
    {
        $oath = $_SESSION['oath_str'];
        $this->assign('adminoath','adminoath');
        $this->assign('admin','admin');
        $this->assign('user','user');
        $this->assign('house','house');
        $this->assign('housecheck','housecheck');
        $this->assign('agency','agency');
        $this->assign('housedepute','housedepute');
        $this->assign('houseconfig','houseconfig');
        $this->assign('reservations','reservations');
        $this->assign('selling_house','selling_house');
        $this->assign('oath',$oath);
        $this->assign('user_img',$_SESSION['think']['admin']['user_img']);

        //获取委托信息的条数
        $where = array();
        $where['take_id'] = array('in','0');
        $is_take = input('get.is_take');
        $houseDepute = new HouseDeputeModel;
        $list = $houseDepute->getList($where);
        $this->assign('message_count',count($list));
        //登陆者id
        $id = $_SESSION['think']['admin']['id'];
        //登录者类型,1表示中介，2表示管理员
        $type = $_SESSION['think']['admin']['type'];
        $this->assign('type',$type);
        $this->assign('id',$id);
        return $this->fetch();
    }

    /**
     * 定时请求获取是否有委托信息
     */
    public function message(){
        $where = array();
        $where['take_id'] = array('in','0');
        $is_take = input('get.is_take');
        $houseDepute = new HouseDeputeModel;
        $list = $houseDepute->getList($where);
        ajaxReturn(count($list),'成功',1);
    }
    public function main(){
        $mysql = Db::name('admin')->query("select VERSION() as version");
        $mysql = $mysql[0]['version'];
        $info = [
            '操作系统'      =>  PHP_OS,
            '运行环境'      => $_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式'   => php_sapi_name(),
            'PHP版本'       => phpversion(),
            'MYSQL版本'     => $mysql,
            'ThinkPHP'      => 'ThinkPHP5.0',
            '上传附件限制'  =>ini_get('upload_max_filesize'),
            '执行时间限制'  => ini_get('max_execution_time') . "s",
            '剩余空间'      => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M'
        ];
        $this->assign('info',$info);

        $info1 = [
            '开发者'      => '张伟江',
            '邮箱'        => '982215226@qq.com',
            '电话'        => '13665994204',
        ];
        $this->assign('info1',$info1);
        echo $this->fetch();
    }

}
