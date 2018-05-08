<?php
namespace app\core\controller;

use think\Cache;
use think\Request;
use app\core\model\User as UserModel;
use app\core\controller\Base as BaseController;

class Api extends BaseController
{
    // 过滤指定控制器及方法，跳过登录验证
    protected $filter = [
        'auth' => ['login', 'register', 'registerverifycode', 'loginverifycode'],
    ];

    public function _initialize()
    {
        parent::_initialize();

        $request    = Request::instance();
        $controller = strtolower($request->controller());
        $action     = strtolower($request->action());
        $authKey    = $request->header('authKey');
        $sessionId  = $request->header('sessionId');
        $cache      = Cache::get('Auth_' . $authKey);

        // 检查用户当前访问控制器是否需要进行登录认证
        if (isset($this->filter[$controller])) {
            if ($this->filter[$controller] == '*') {
                goto end;
            }
            if (is_array($this->filter[$controller]) && in_array($action, $this->filter[$controller])) {
                goto end;
            }
        }

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
        end:
        return null;
    }
}
