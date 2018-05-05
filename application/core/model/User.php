<?php
namespace app\core\model;

use think\Db;
use think\Model;

class User extends Model
{
    protected $name = 'admin_user';

    /**
     * 查询满足指定条件的单个用户数据
     *
     * @param array $map
     * @return void
     */
    public function findUser(array $map)
    {
        return Db::name($this->name)->where($map)->find();
    }

    /**
     * 查询满足指定条件的所有用户数据
     *
     * @param array $map
     * @return void
     */
    public function findUsers(array $map)
    {
        return Db::name($this->name)->where($map)->select();
    }
}
