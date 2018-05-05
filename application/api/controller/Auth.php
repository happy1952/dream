<?php
namespace app\api\controller;

use app\core\controller\Api as ApiController;
use think\Request;
use app\api\validate\Auth as AuthValidate;
use app\api\model\Auth as AuthModel;

class Auth extends ApiController
{
    public function login()
    {

    }

    public function register(Request $request)
    {
        $data = [];
        $data['username'] = $request->post('username');
        $data['password'] = $request->post('password');

        try {
            $auth_validate = new AuthValidate();
            if ($auth_validate->scene('register')->check($request->post())) {
                throw new \Exception($auth_validate->getError(), 400);
            }
            $auth_model = new AuthModle();
        } catch (\Exception $e) {
            $this->_error($e);
        }
    }
}
