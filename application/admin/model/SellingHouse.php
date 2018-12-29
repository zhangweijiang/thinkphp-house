<?php
/**
 * table:second_hand_house
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/24
 * Time: 21:02
 */

namespace app\admin\model;

use think\Model;

class SellingHouse extends Model
{
    //装修情况
    public function getDecorationAttr($value)
    {
        $data = [0=>'无',1=>'精装修',2=>'普通装修',3=>'毛坯房'];
        return $data[$value];
    }
    //供暖方式
    public function getHeatingMethodAttr($value)
    {
        $data = [0=>'无',1=>'自供暖',2=>'集体供暖'];
        return $data[$value];
    }

    //所在楼层
    public function getFloorAttr($value)
    {
        $data = [0=>'无',1=>'底层',2=>'低楼层',3=>'中楼层',4=>'高楼层',5=>'顶层'];
        return $data[$value];
    }

    //户型结构
    public function getFamilyStructureAttr($value)
    {
        $data = [0=>'无',1=>'平层',2=>'跃层'];
        return $data[$value];
    }

    //建筑类型
    public function getBuildingTypeAttr($value)
    {
        $data = [0=>'无',1=>'塔楼',2=>'板楼',3=>'塔板结合'];
        return $data[$value];
    }

    //建筑结构
    public function getBuildingStructureAttr($value)
    {
        $data = [0=>'无',1=>'钢混结构',2=>'钢结构',3=>'砖混结构'];
        return $data[$value];
    }

    //电梯
    public function getLiftAttr($value)
    {
        $data = [0=>'无',1=>'有',2=>'没有'];
        return $data[$value];
    }

    //看房时间
    public function getSeeHouseTimeAttr($value)
    {
        $data = [0=>'无',1=>'有租房需要预约',2=>'提前预约随时可看'];
        return $data[$value];
    }


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

}