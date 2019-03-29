<?php

//环境设置
error_reporting(E_ALL);
ini_set('display_errors', 'on');
date_default_timezone_set('Asia/Shanghai');
setlocale(LC_MONETARY, 'zh_CN');

//引入框架核心文件
require __DIR__ . '/../lib/Start.php';

//设置请求路径
if(isset($_GET['s']))  $_SERVER['PATH_INFO'] = $_GET['s'];

//可以在此处引入composer
//require_once __DIR__ . "/../vendor/autoload.php";

//获得框架单例
$start = lib\Start::getInstance();

//设置应用目录
$start->setAppName('app');

//设置配置文件
$start->setConfigFile(__DIR__ . "/../config.php");

//创建路由
$start->boot();

//分发请求
$start->dispatch();


