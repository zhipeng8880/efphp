<?php
$config = [
    '_debug'    => true,        //调试模式开关
    '_pwd_salt' => '*&%JHG877', //密码盐
    '_mysql'    => [
        'master' => [
            'host' => 'localhost',
            'port' => 3306,
            'user' => 'root',
            'password' => '123456',
            'database' => 'efphp',
            'charset' => 'utf8',
            'persitent' => true
        ],
        "slave" =>[
            [
                'host' => '127.0.0.1',
                'port' => 3306,
                'user' => 'root',
                'password' => '<App123>',
                'database' => 'search',
                'charset' => 'utf8',
                'persitent' => true
            ],
            [
                'host' => '127.0.0.1',
                'port' => 3306,
                'user' => 'root',
                'password' => '<App123>',
                'database' => 'search',
                'charset' => 'utf8',
                'persitent' => true
            ]
        ],
    ],  //mysql主从
    '_mongodb'  => [
        'master' => [
            'host' => '127.0.0.1',
            'port' => 24997,
            'user' => 'user',
            'password' => '123456',
            'database' => 'app',
            'replicaSet' => 'app'
        ],
        "slave" =>[],
    ],
    '_redis'    => [
        'master' => [
            'host' => '127.0.0.1',
            'port' => 6379,
            'pwd'  =>''
        ],
        "slave" =>[
            [
                'host' => '127.0.0.1',
                'port' => 6379,
                'pwd'  =>''
            ],
            [
                'host' => '127.0.0.1',
                'port' => 6379,
                'pwd'  =>''
            ]
        ],
    ],  //redis主从
    '_logDir'   => __DIR__ . "/log/",  //日志目录
    '_es'       => [],  //es配置

];
