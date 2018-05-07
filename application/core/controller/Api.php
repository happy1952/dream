<?php
namespace app\core\controller;

use app\core\controller\Base as BaseController;
use think\Request;
use think\Cache;
use app\core\model\User as UserModel;

class Api extends BaseController
{
    public function _initialize()
    {
        parent::_initialize();

        $request    = Request::instance();
        $authKey    = $request->header('authKey');
        $sessionId  = $request->header('sessionId');
        $cache      = Cache::get('Auth_' . $authKey);

        try {
            if (empty($authKey) || empty($sessionId) || empty($cache)) {
                throw new \Exception('登录失效', 401);
            }
            $userInfo = $cache['userInfo'];
            $map['id'] = $userInfo['id'];
            $map['status'] = 1;
            $user = new UserModel();
            $user = $user->findUser($mpa);
            dump($user);
            exit;
            if (!$user) {
                throw new \Exception('账户被删除或已禁用', 401);
            }
        } catch (\Exception $e) {
            $this->_error($e);
            echo json_encode($this->_response, JSON_UNESCAPED_UNICODE);
            exit();
        }
    }
}
