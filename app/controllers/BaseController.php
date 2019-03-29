<?php
namespace app\controllers;

use lib\Controller;

/**
 * 控制器基类，一些控制器的公共方法可以写在此处
 * Class BaseController
 * @package app\controllers
 */
class BaseController extends Controller
{
    /**
     * 示例方法
     */
    public function foo()
    {
        return "EFPHP is a easy and fast php framework.";
    }
}