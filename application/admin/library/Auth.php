<?php
namespace app\admin\library;

use app\admin\model\AdminUser as UserModel;
use app\admin\model\AdminMenu as MenuModel;
use think\facade\Session;

class Auth
{
    protected $sessionName = 'admin';

    public function login($username,$password)
    {
        $user = UserModel::get(['username' => $username]);
        if(!$user) {
            $this->setError('用户不存在');
            return false;
        }
        if ($user->password != $this->passwordMD5($password, $user->salt)) {
            $this->setError('用户或密码不正确');
            return false;
        }
        Session::set($this->sessionName, ['id' => $user->id]);
        return true;
    }
    protected $error;
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    public function getError()
    {
        return $this->error;
    }

    public function passwordMD5($password, $salt)
    {
        return md5(md5($password) . $salt);
    }

    protected static $instance;
    
    public static function getInstance($options = [])
    {
        if (is_null(self::$instance)) {
            self::$instance = new static($options);
        }
        return self::$instance;
    }

    public function isLogin()
    {
        return Session::has($this->sessionName . '.id');
    }

    public function logout()
    {
        Session::delete($this->sessionName);
        return true;
    }

    public function menu($controller)
    {
        return MenuModel::tree()->getTree(strtolower($controller));
    }
}