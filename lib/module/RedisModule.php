<?php

namespace lib\module;

use lib\Start;
use Redis;

class RedisModule
{
    private $_config;

    public function __construct()
    {
        $this->_config = Start::getInstance()->getConfig();
    }

    /**
     * 连接到 redis 主服务器
     */
    public function master()
    {
        $host = $this->_config['_redis']['master']['host'];
        $port = $this->_config['_redis']['master']['port'];
        try{
            $redis = new Redis();
            $redis->connect($host, $port);
            if("+PONG"==$redis->ping())
                return $redis;
            else
                return false;
        }catch (\Exception $e){
            echo $e->getMessage();
            return false;
        }

    }

    /**
     * 连接到 redis 辅服务器
     */
    public function slave()
    {
        $slaveID = 0;
        $host = $this->_config['_redis']['slave'][$slaveID]['host'];
        $port = $this->_config['_redis']['slave'][$slaveID]['port'];

        try{
            $redis = new Redis();
            $redis->connect($host, $port);
            if("+PONG"==$redis->ping())
                return $redis;
            else
                return false;
        }catch (\Exception $e){
            echo $e->getMessage();
            return false;
        }
    }

}