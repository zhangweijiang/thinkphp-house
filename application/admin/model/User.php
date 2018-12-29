<?php
/**
 * table:user
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/24
 * Time: 21:02
 */

namespace app\admin\model;

use think\Model;

class User extends Model
{
    /**
     * 登录
     * @param $username
     * @param $password
     * @return int
     */
    public function login($username, $password)
    {
        //获取用户数据
        $admin = $this->where('username', $username)->field(true)->find();
        if($admin){
            $admin = $admin->toArray();
        }
        //判断用户是否存在
        if ($admin) {
            //判断用户可用状态
            if ($admin['status']) {
                //验证用户密码
                if (sha256($password) === $admin['password']) {//密码正确
                    //记录登录session
                    session('admin', $admin);
                    session('admin_sign', dataAuthSign($admin));
                    return $admin['id']; //登录成功，返回用户ID
                } else {
                    return -2; //用户密码错误
                }
            } else {
                return -3; //用户被禁用
            }
        } else {
            return -1; //用户不存在
        }
    }

    /**
     * 注册
     * @param $username
     * @param $password
     * @return int
     */
    public function register($username, $password)
    {
        $data = array();
        //查询用户是否存在
        if ($user = $this->where('username', $username)->find()) {
            return -1; //用户已存在
        } else { //用户不存在
            $data["username"] = $username;
            $data["password"] = sha256($password);
            $data['type'] = 1;//1表示中介，2表示管理员
            $data['add_time'] = time();
            $this->save($data);

            return 1; //注册成功
        }
    }

    //获取权限列表--多条
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