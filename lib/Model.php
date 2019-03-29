<?php

namespace lib;

use lib\module\MysqliModule;


/**
 * 模型，负责数据处理，比如mysql，redis，es，kafka，等
 * 框架的版本中会持续增加对各种数据的处理模块，即module
 * Class Model
 * @package lib
 */
class Model
{
    protected $_table;      //Table name
    protected $_pk = 'id';  //Primary key
    protected $_mysqli;
    public $_service;

    public function __construct()
    {
        $this->_service = Start::getInstance();
        $this->_mysqli = new MysqliModule();
    }

    /**
     * 用主键查询1条数据
     * @param int $id
     * @param null $col
     * @return array|bool
     */
    public function load($id, $col = null)
    {
        if (is_null($col)) $col = $this->_pk;
        $where =  $col." = " . (is_int($id) ? $id : "'$id'");
        $result = $this->_mysqli->select($this->_table,$where);
        if($result['code']==200)
            $result['data'] = isset($result['data'][0])?$result['data'][0]:[];
        return $result;

    }


    /**
     * 条件查询多条数据
     * @param string $conditions
     * @return array
     */
    public function find($conditions='')
    {
        $result = $this->_mysqli->select($this->_table,$conditions);

        return $result;
    }

    /**
     * 条件查询记录数
     * @param string $conditions
     * @return array
     */
    public function count($conditions='')
    {
        $result = $this->_mysqli->select($this->_table,$conditions);

        return $result;
    }

    /**
     * 新增数据
     * @param array $data
     * @return array
     */
    public function insert($data)
    {
        return $this->_mysqli->insert($data, $this->_table);
    }

    /**
     * 更新数据
     * @param int $id
     * @param array $data
     * @return array
     */
    public function update($id, $data)
    {
        $where = $this->_pk . '=' . (is_int($id) ? $id : "'$id'");
        return $this->_mysqli->update($data, $where, $this->_table);
    }


    /**
     * 删除数据
     * @param $id
     * @param null $col
     * @return array
     */
    public function delete($id, $col = null)
    {
        if (is_null($col)) $col = $this->_pk;

        $where = $col . '=' . (is_int($id) ? $id : "'$id'");

        return $this->_mysqli->delete($where, $this->_table);
    }


}