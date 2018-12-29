<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\SellingHouse as SellingHouseModel;
use app\admin\model\SellingHouseImg as SellingHouseImgModel;
class SellingHouse extends BaseController
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
     * 房屋出售列表
     */
   public function index(){
       $bread = array(
           '0' => array(
               'name' => '房屋管理',
               'url' => ''
           ),
           '1' => array(
               'name' => '房屋出售列表',
               'url' => '/admin/selling_house/index'
           )
       );
       $this->assign('breadhtml', $this->getBread($bread));
       $this->search();
       echo $this->fetch();
   }

    /**
     * 通过主键id删除数据
     */
   public function delete(){
       $id = input('post.id');
       $secondHandHouseImg = new SellingHouseImgModel;
       $secondHandHouseImg->deleteBySellingHouseId($id);
       $secondHandHouse = new SellingHouseModel;
       $re = $secondHandHouse->deleteById($id);
       if($re){
           ajaxReturn('','删除成功',1);
       }else{
           ajaxReturn('','删除失败',0);
       }
   }


    /**
     * 二手房添加和编辑页面
     */
    public function set(){
        $id = input('get.id');
        $bread = array(
            '0' => array(
                'name' => '房屋管理',
                'url' => ''
            ),
            '1' => array(
                'name' => '房屋出售列表',
                'url' => '/admin/selling_house/index'
            ),
            '2' => array(
                'name' => '房屋出售设置',
                'url' => '/admin/selling_house/set?id='.$id
            )
        );
        $this->assign('breadhtml', $this->getBread($bread));
        //处理编辑界面
        if ($id) {
            $house = new SellingHouseModel;
            $data = $house->findById($id);
            $this->assign('data', $data);
        }
        echo $this->fetch();
    }

    /**
     * 添加和编辑的保存
     */
    public function save(){
        $secondHandHouse = new SellingHouseModel;
        $secondHandHouseImg = new SellingHouseImgModel;
        $id = input('post.id');
        $data = input('post.');
        $data['total_money'] = round($data['money']*$data['building_acreage'],2);
        if (request()->isPost()) {
            if($id){  //编辑的保存
                $where = array('id'=>$id);
                $second_hand_house_id = $id;
                $files = request()->file('file');
                if($files){
                    //删除原来的图片
                    $orihouseImg = $secondHandHouseImg->getList(['selling_house_id'=>$second_hand_house_id]);
                    if($orihouseImg){
                        foreach($orihouseImg as $o){
                            deleteFile(ROOT_PATH . 'public' . DS . 'upload/'.$o['filename']);//删除原始图片
                        }
                    }
                    $secondHandHouseImg->deleteBySellingHouseId($id);
                    foreach($files as $file){
                        // 移动到框架应用根目录/public/uploads/ 目录下
                        $info = $file->move(ROOT_PATH . 'public' . DS . 'upload');
                        $house_img = array();
                        $house_img['selling_house_id'] = $second_hand_house_id;
                        if($info){
                            // 成功上传后 获取上传信息
                            // 输出 42a79759f284b767dfcb2a0197904287.jpg
                            $house_img['filename'] =  $info->getSaveName();
                            $secondHandHouseImg->addData($house_img);
                        }else{
                            // 上传失败获取错误信息
                            echo $file->getError();
                        }
                    }
                }
                $re = $secondHandHouse->updateData($data,$where);
                if($re!==FALSE){
                    ajaxReturn('','保存成功',1);
                }else{
                    ajaxReturn('','保存失败',1);
                }
            }else{  //添加的保存
                $house_id = $secondHandHouse->order('id desc')->find();
                if($house_id){
                    $data['house_sn'] = makeOrderSn($house_id['id']+1);
                }else{
                    $data['house_sn'] = makeOrderSn(1);
                }
                $data['add_time'] = time();
                $data['admin_id'] = $_SESSION['think']['admin']['id'];
                $data['username'] = $_SESSION['think']['admin']['username'];
                $re = $secondHandHouse->addData($data);
                $second_hand_house_id = $secondHandHouse->getLastInsID();
                // 获取表单上传文件
                $files = request()->file('file');
                if($files){
                    foreach($files as $file){
                        // 移动到框架应用根目录/public/uploads/ 目录下
                        $info = $file->move(ROOT_PATH . 'public' . DS . 'upload');
                        $house_img = array();
                        $house_img['add_time'] = time();
                        $house_img['selling_house_id'] = $second_hand_house_id;
                        if($info){
                            // 成功上传后 获取上传信息
                            // 输出 42a79759f284b767dfcb2a0197904287.jpg
                            $house_img['filename'] =  $info->getSaveName();
                            $secondHandHouseImg->addData($house_img);
                        }else{
                            // 上传失败获取错误信息
                            echo $file->getError();
                        }
                    }
                }
                if($re>0){
                    ajaxReturn('','保存成功',1);
                }else{
                    ajaxReturn('','保存失败',0);
                }
            }
        }
    }

    public function successReturn(){
        $data = I('post.');
        $file = $_FILES;
        ajaxReturn($data,$file,'1');//1 表示成功
    }


    //刷新页面
    public function refresh(){
        $this->search();
        ajaxReturn($this->fetch('ajaxPage'),'刷新成功',1);
    }

    public function search(){
        //搜索条件
        $where = array();
        $type = $_SESSION['think']['admin']['type'];//1中介,2管理员
        if($type==1){
            $where['admin_id'] = $_SESSION['think']['admin']['id'];
        }
        $name = input('get.name');
        $type = input('get.type');
        if($name){
            $where['name'] = array('like','%'.$name.'%');
            $this->assign('name',$name);
        }
        if($type){
            $where['type'] = array('like','%'.$type.'%');
            $this->assign('type',$type);
        }
        $secondHandHouse = new SellingHouseModel;
        $list = $secondHandHouse->getList($where);
        $houseImg = new SellingHouseImgModel;
        if($list){
            foreach($list as &$v){
                $house_img = array();
                $house_img = $houseImg->getList(['selling_house_id'=>$v['id']]);
                $v['house_img'] = $house_img;
            }
        }
        $this->assign('list',$list);
    }

    //获取图片
    public function houseImg(){
        $this->search();
        $id = input('post.id');
        $house = new SellingHouseModel;
        $houseInfo = $house->findById($id);
        $houseImg = new SellingHouseImgModel;
        $houseImgList = $houseImg->getList(['selling_house_id'=>$houseInfo['id']]);
        $this->assign('houseImgList',$houseImgList);
        if($houseImgList){
            ajaxReturn($this->fetch('houseImgAjax'),'更新成功',1);
        }else{
            ajaxReturn('','更新失败',0);
        }
    }



}
