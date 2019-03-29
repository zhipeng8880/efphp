<?php

namespace lib;

/**
 * 一些动态变量的注释，方便IDE跟踪代码。
 *
 * @property string word
 * @property array|null result
 * @property int rows
 * @property string msg
 * @property int total
 * @property float sec
 * @property int num
 * @property array menus
 * @property string title
 * @property string foot
 * @property string content
 * @property array data
 */

class View
{
    public function display($tpl)
    {
        echo $this->_render($tpl);
    }

    public function fetch($tpl)
    {
        return $this->_render($tpl);
    }

    protected function _render($tpl)
    {
        ob_start();
        ob_implicit_flush(0);
        $file = $tpl;

        /** @noinspection PhpIncludeInspection */
        include $file;
        return ob_get_clean();
    }

    public function __set($key, $value = null)
    {
        $this->$key = $value;
    }

    public function __get($key)
    {
        return null;
    }
}