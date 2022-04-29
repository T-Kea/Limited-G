<?php
namespace app\admin\validate;

use think\Validate;

class AdminUser extends Validate
{
    protected $rule = [
        'username'=>'require|max:32',
        'password'=>'require|min:6',
    ];

    protected $message = [
        'username.require' => '用户名不能为空',
        'username.max' => '用户名最多为32个字符',
        'password.reqiure' => '密码不能为空',
        'password.min' => '密码最少为6位',
        'captcha.require' => '验证码那不能为空',
        'captcha.captcha' => '验证码有误',
        'username.unique' => '用户名已存在'
    ];
}

