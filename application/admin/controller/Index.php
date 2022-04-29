<?php
namespace app\admin\controller;

//use think\Controller;
use app\admin\validate\AdminUser as UserValidate;
use think\App;
use think\Db;

class Index extends Common
{
    public function login()
    {
        if($this->request->isPost()){
            $data = [
                'username'=>$this->request->post('username/s','','trim'),
                'password'=>$this->request->post('password/s',''),
                'captcha'=>$this->request->post('captcha/s','','trim')
            ];
            $validate = new UserValidate;
            if(!$validate->scene('login')->check($data)) {
                $this->error('登录失败:' . $validate->getError() . '。');
            }
            if(!$this->auth->login($data['username'], $data['password'])) {
                $this->error('登录失败：' . $this->auth->getError() . '。');
            }
            $this->success('登录成功。');
        }
        //$this->assign('token',$this->request->token('X-CSRF-TOKEN'));
        $this->assign('token',$this->getToken());
        return $this->fetch();

    }

    public function index(App $app)
    {
        return $this->fetch();
    }

    private function getMySQLVer()
    {
        $res = Db::query('SELECT VERSION() AS ver');
        return isset($res[0])?$res[0]['ver']:'未知';
    }

    protected $checkLoginExclude = ['login'];

    public function logout()
    {
        $this->auth->logout();
        $this->redirect('Index/login');
    }

}