<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/24
 * Time: 19:26
 */

namespace app\admin\validate;

use think\Validate;

class Login extends Validate
{
    protected $rule = [
        'username' => 'require|max:25',
        'password' => 'require|min:6|max:16',
        'captcha_code' => 'require|captcha',
    ];

    protected $message = [
        'username.require' => '名称必须',
        'username.max' => '名称最多不能超过25个字符',
        'password.require'     => '密码不能为空',
        'password.min'         => '密码为6~16位字符',
        'password.max'         => '密码为6~16位字符',
        'captcha_code.require' => '请输入验证码',
        'captcha_code.captcha' => '验证码错误',
    ];
}