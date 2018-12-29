<?php
/**
 * table:second_hand_house_img
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/24
 * Time: 21:02
 */

namespace app\pc\model;

use think\Model;

class SellingHouseImg extends Model
{
    //获取信息--多条
    public function getList($where=array(),$order="id desc"){
        return $this->where($where)->order($order)->select();
    }
    //通过主键id获取一条数据
    public function findById($id){
        return $this->where(['id'=>$id])->find();
    }


    //通过主键id删除数据
    public function deleteById($id){
        return $this->where(['id'=>$id])->delete();
    }

    //插入数据
    public function addData($data){
        return $this->isUpdate(false)->data($data, true)->save();
    }

    //更新数据
    public function updateData($data,$where){
        $this->isUpdate(true)->save($data,$where);
    }

    //通过主键id删除数据
    public function deleteBySecondHandHouseId($id){
        return $this->where(['second_hand_house_id'=>$id])->delete();
    }

}