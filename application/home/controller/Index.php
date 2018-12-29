<?php
namespace app\index\controller;
use think\Controller;
use \think\Request;
class Index extends Controller
{
    public function index()
    {
        echo 'home';
        return $this->fetch();
    }

}
