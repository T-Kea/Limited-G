<?php
namespace app\index\controller;

use app\index\controller\Common;


class Index extends Common
//class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}

