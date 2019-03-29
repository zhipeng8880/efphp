<?php

namespace lib\module;


use lib\Start;

class MysqliModule
{
    private $mysqli;
    private $error;

    /**
     * 获得mysql连接，目前只支持连接主库，下一版本将增加连接从库的配置
     * @return bool|\Mysqli
     */
    public function getConnection()
    {
            $_config = Start::getInstance()->getConfig();

            //面向对象方式
            $this->mysqli = new \Mysqli(
                $_config['_mysql']['master']['host'],
                $_config['_mysql']['master']['user'],
                $_config['_mysql']['master']['password'],
                $_config['_mysql']['master']['database']
            );

            //面向对象方式屏蔽了连接产生的错误，需要通过函数来判断
            if(mysqli_connect_error())
            {
                $this->error =  mysqli_connect_error();
                return false;
            }else{
                //设置编码
                $this->mysqli->set_charset($_config['_mysql']['master']['charset']);
                return $this->mysqli;
            }
    }


    public function select($table,$where)
    {
        if(!empty($this->error))
            return[
                "code"=>500,
                "status"=>false,
                "msg"=>$this->error
            ];

        $mysqli = $this->getConnection();

        if(empty($where))
            $sql = "SELECT * FROM ".$table;
        else
            $sql = "SELECT * FROM ".$table." where ".$where;

        $result = $mysqli->query($sql);

        $errno = $mysqli->errno;
        $error = $mysqli->error;

        $mysqli->close();

        //执行失败
        if($result === false){
            return[
                "code"=>500,
                "status"=>false,
                "msg"=>$errno."  ".$error
            ];
        }

        //执行成功
        return[
            "code"=>200,
            "status"=>true,
            "data"=>$result->fetch_all(MYSQLI_ASSOC),//$result->data_seek(0);//如果前面有移动指针则需重置
            "rows"=>$result->num_rows, //行数
            "field"=>$result->field_count,//列数 字段数
            "field_info"=>$result->fetch_fields(),//获取字段信息
        ];

    }


    public function insert($data,$table)
    {
        if(!empty($this->error))
            return[
                "code"=>500,
                "status"=>false,
                "msg"=>$this->error
            ];

        if(empty($data)|| empty($table))
            return[
                "code"=>500,
                "status"=>false,
                "msg"=>"data or table is empty"
            ];

        $mysqli = $this->getConnection();

        $key = '';
        $value = '';

        foreach ($data as $k=>$v)
        {
            $key .= '`'.$k.'`,';
            $value .= '\''.$v.'\',';
        }
        $key    = trim($key,',');
        $value  = trim($value,',');

        $sql = "insert into `".$table."` (".$key.") values (".$value.")";

        $result = $mysqli->query($sql);
        $errno = $mysqli->errno;
        $error = $mysqli->error;
        $insert_id = $mysqli->insert_id;//插入的id

        $mysqli->close();

        //执行失败
        if($result === false){
            return[
                "code"=>500,
                "status"=>false,
                "msg"=>$errno."  ".$error
            ];
        }

        //执行成功
        return[
            "code"=>200,
            "status"=>true,
            "insert_id"=>$insert_id,
        ];
    }


    public function delete($where,$table)
    {
        if(!empty($this->error))
            return[
                "code"=>500,
                "status"=>false,
                "msg"=>$this->error
            ];

        if(empty($where)|| empty($table))
            return[
                "code"=>500,
                "status"=>false,
                "msg"=>"where or table empty error"
            ];

        $mysqli = $this->getConnection();

        $sql = "delete FROM ".$table." where ".$where;

        $result = $mysqli->query($sql);

        $errno = $mysqli->errno;
        $error = $mysqli->error;

        $mysqli->close();

        //执行失败
        if($result === false){
            return[
                "code"=>500,
                "status"=>false,
                "msg"=>$errno."  ".$error
            ];
        }

        //执行成功
        return[
            "code"=>200,
            "status"=>true
        ];
    }


    public function update($data, $where, $table)
    {
        if(!empty($this->error))
            return[
                "code"=>500,
                "status"=>false,
                "msg"=>$this->error
            ];

        if(empty($data) || empty($table) || empty($where))
            return[
                "code"=>500,
                "status"=>false,
                "msg"=>"data or table or where is empty "
            ];

        $mysqli = $this->getConnection();

        $value = '';

        foreach ($data as $k=>$v)
        {
            $value .= "`".$k."` = '".$v."',";
        }
        $value  = trim($value,',');

        $sql = "update `".$table."` set $value where ".$where;

        $result = $mysqli->query($sql);

        $errno = $mysqli->errno;
        $error = $mysqli->error;

        $mysqli->close();

        //执行失败
        if($result === false){
            return[
                "code"=>500,
                "status"=>false,
                "msg"=>$errno."  ".$error
            ];
        }

        //执行成功
        return[
            "code"=>200,
            "status"=>true,
        ];
    }

}