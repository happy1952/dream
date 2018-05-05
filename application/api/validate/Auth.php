<?php
namespace app\api\validate;

use think\Validate;

class Auth extends Validate
{
    // 验证规则
    protected $rule = [
        'username'          => 'require|min:2|max:32',
        'password'          => 'require|min:6|max:16',
        'confirmpassword'   => 'confirm:password',
        'email'             => 'require|email',
        'verifycode'        => 'require',
    ];

    // 提示信息
    protected $message = [
        'username.require'      => '请输入用户名',
        'username.min'          => '用户名长度不得小于2个字符',
        'username.max'          => '用户名长度不得大于32个字符',
        'password.require'      => '请输入密码',
        'password.min'          => '密码长度不得小于6个字符',
        'password.max'          => '密码长度不得大于16个字符',
        'confirmpassword.confirm' => '两次输入密码不一致',
        'email.require'         => '请输入邮箱地址',
        'email.email'           => '请输入正确的邮箱地址',
        'verifycode.require'    => '请输入验证码',
    ];

    // 应用场景
    protected $scene = [
        'login' => ['username', 'password', 'verifycode'],
        'register' => ['username', 'password', 'confirmpassword', 'email', 'verifycode'],
    ];
}
