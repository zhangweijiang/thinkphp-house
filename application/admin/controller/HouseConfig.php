<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\HouseConfig as HouseConfigModel;
class HouseConfig extends BaseController
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
     * 房屋列表
     */
   public function index(){
       $bread = array(
           '0' => array(
               'name' => '房屋管理',
               'url' => ''
           ),
           '1' => array(
               'name' => '房屋配置列表',
               'url' => '/admin/house_config/index'
           )
       );
       $this->assign('breadhtml', $this->getBread($bread));
       $this->search();
       echo $this->fetch();
   }


    //刷新页面
    public function refresh(){
        $this->search();
        ajaxReturn($this->fetch('ajaxPage'),'刷新成功',1);
    }

    public function search(){
        //搜索条件
        $where = array();
        $name = input('get.name');
        if($name){
            $where['name'] = array('like','%'.$name.'%');
            $this->assign('name',$name);
        }
        $houseConfig = new HouseConfigModel;
        $list = $houseConfig->getList($where);
        $this->assign('list',$list);
    }

    /**
     * 通过主键id删除数据
     */
    public function delete(){
        $id = input('post.id');
        $houseConfig = new HouseConfigModel;
        $re = $houseConfig->deleteById($id);
        if($re){
            ajaxReturn('','删除成功',1);
        }else{
            ajaxReturn('','删除失败',0);
        }
    }

    /**
     * 房屋配置添加和编辑页面
     */
    public function set(){
        $id = input('get.id');
        $bread = array(
            '0' => array(
                'name' => '房屋管理',
                'url' => ''
            ),
            '1' => array(
                'name' => '房屋配置列表',
                'url' => '/admin/house_config/index'
            ),
            '2' => array(
                'name' => '房屋配置设置',
                'url' => '/admin/house_config/set?id='.$id
            )
        );
        $this->assign('breadhtml', $this->getBread($bread));
        //处理编辑界面
        if ($id) {
            $houseConfig = new HouseConfigModel;
            $data = $houseConfig->findById($id);
            $this->assign('data', $data);
        }
        echo $this->fetch();
    }

    /**
     * 添加和编辑的保存
     */
    public function save(){
        $houseConfig = new HouseConfigModel;
        $id = input('post.id');
        $data = input('post.');
        if (request()->isPost()) {

            $data = input('post.');
            if($id){  //编辑的保存
                $where = array('id'=>$id);
                // 获取表单上传文件 例如上传了001.jpg
                $file = request()->file('filename');

                // 移动到框架应用根目录/public/uploads/ 目录下
                if($file){
                    $info = $file->move(ROOT_PATH . 'public' . DS . 'upload');
                    if($info){
                        // 成功上传后 获取上传信息;
                        // 输出 20171224/42a79759f284b767dfcb2a0197904287.jpg
                        $data['filename'] =  $info->getSaveName();
                    }else{
                        // 上传失败获取错误信息
                        ajaxReturn('','图片上传失败',1);
                    }
                }
                $re = $houseConfig->updateData($data,$where);
                if($re!==FALSE){
                    ajaxReturn('','保存成功',1);
                }else{
                    ajaxReturn('','保存失败',1);
                }
            }else{  //添加的保存
                $data['add_time'] = time();
                // 获取表单上传文件 例如上传了001.jpg
                $file = request()->file('filename');

                // 移动到框架应用根目录/public/uploads/ 目录下
                if($file){
                    $info = $file->move(ROOT_PATH . 'public' . DS . 'upload');
                    if($info){
                        // 成功上传后 获取上传信息;
                        // 输出 20171224/42a79759f284b767dfcb2a0197904287.jpg
                        $data['filename'] =  $info->getSaveName();
                    }else{
                        // 上传失败获取错误信息
                        ajaxReturn('','图片上传失败',1);
                    }
                }
                $re = $houseConfig->addData($data);
                if($re>0){
                    ajaxReturn('','保存成功',1);
                }else{
                    ajaxReturn('','保存失败',1);
                }
            }
        }
    }








}
