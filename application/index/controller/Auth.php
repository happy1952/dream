<?php
namespace app\index\controller;

use app\core\controller\Base as BaseController;

class Auth extends BaseController
{
    public function login()
    {
        return $this->fetch();
    }

    public function register()
    {
        return $this->fetch();
    }
}
