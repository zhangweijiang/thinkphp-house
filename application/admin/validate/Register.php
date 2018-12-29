<?php

namespace app\admin\validate;

use think\Validate;

//注册验证类
class Register extends Validate
{
    protected $rule = [ //验证规则
        'username'   => 'require|max:25',
        'password'   => 'require|min:6|max:16',
        'repassword' => 'require|confirm:password',
    ];

    protected $message = [ //错误提示信息
        'username.require'   => '昵称不能为空',
        'username.max'       => '昵称长度为25个字符以内',
        'password.require'   => '密码不能为空',
        'password.min'       => '密码为6~16位字符',
        'password.max'       => '密码为6~16位字符',
        'repassword.require' => '请再次输入密码',
        'repassword.confirm' => '两次输入密码不一致',
    ];

}