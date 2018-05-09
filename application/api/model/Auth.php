<?php
namespace app\api\model;

use app\core\model\Api as ApiModel;

class Auth extends ApiModel
{
    protected $table = 'think_admin_user';
    protected $name = 'admin_user';

    public function login(array $data)
    {
        unset($data['confirmpassword']);
        unset($data['verifycode']);
        $data['updated_at'] = $data['created_at'] = time();
        $sql = "INSERT INTO {$this->table}";
    }
}
