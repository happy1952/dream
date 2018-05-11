<?php
namespace app\api\controller;

use think\Request;
use custom\verify\Captcha;
use app\api\model\Auth as AuthModel;
use app\api\validate\Auth as AuthValidate;
use app\core\controller\Api as ApiController;

class Auth extends ApiController
{
    // login
    public function login(Request $request)
    {
        $data['username'] = $request->post('username');
        $data['password'] = $request->post('password');

        try {
            $auth_validate = new AuthValidate();
            if (!$auth_validate->scene('login')->check($data)) {
                throw new \Exception($auth_validate->getError(), 400);
            }
        } catch (\Exception $e) {
            $this->_error($e);
        }
        return $this->_response;
    }

    public function register(Request $request)
    {
        $data['username']        = $request->post('username', '', 'htmlspecialchars');
        $data['password']        = $request->post('password');
        $data['confirmpassword'] = $request->post('confirmpassword');
        $data['email']           = $request->post('email');
        $data['verifycode']      = $request->post('verifycode');

        try {
            $auth_validate = new AuthValidate();
            if (!$auth_validate->scene('register')->check($data)) {
                throw new \Exception($auth_validate->getError(), 400);
            }
            $captcha = new Captcha();
            if (!$captcha->check($data['verifycode'], '_authRegister')) {
                throw new \Exception('验证码错误', 400);
            }
            $auth_model = new AuthModel();
            $auth_model->login($data);
        } catch (\Exception $e) {
            $this->_error($e);
        }
        return $this->_response;
    }

    /**
     * 展示登录页面验证码
     *
     * @return void
     */
    public function loginVerifyCode()
    {
        $captcha = new Captcha();
        return  $captcha->entry('_authLogin');
    }

    /**
     * 展示注册页面验证码
     *
     * @return void
     */
    public function registerVerifyCode()
    {
        $captcha = new Captcha();
        // $captcha->codeSet   = 'UTF-8'; // 验证码字符集合
        // $captcha->expire    = 0; // 验证码过期时间（s）
        // $captcha->useZh     = true; // 使用中文验证码
        // $captcha->zhSet     = '中文验证码字符串成心行工农民商房天上下左右'; // 中文验证码字符串
        // $captcha->useImgBg  = false; // 使用背景图片
        // $captcha->fontSize  = 16; // 验证码字体大小(px)
        // $captcha->useCurve  = true; // 是否画混淆曲线
        // $captcha->useNoise  = true; // 是否添加杂点
        // $captcha->imageH    = 36; // 验证码图片高度，设置为 0 为自动计算
        // $captcha->imageW    = 115; // 验证码图片宽度，设置为 0 为自动计算
        // $captcha->length    = 4; // 验证码位数
        // $captcha->fontttf   = ''; // 验证码字体，不设置是随机获取
        // $captcha->bg        = [243, 251, 254]; // 背景颜色[243, 251, 254]
        // $captcha->reset     = true; // 验证成功后是否重置
        return  $captcha->entry('_authRegister');
    }
}
