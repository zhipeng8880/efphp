<?php

namespace lib;

/**
 * 控制器，负责参数验证，业务服务组装，不处理具体的业务逻辑。
 */
class Controller
{
    public $request;
    public $model;
    public $view;
    public $_service;

    public function __construct()
    {
        $this->request  = new Request();
        $this->view     = new View();
        $this->_service = Start::getInstance();
    }

    /**
     * 重定向
     * @param $url
     * @param int $code
     */
    protected function redirect($url, $code = 302)
    {
        header("Location:$url", true, $code);
        exit();
    }

    /**
     * 输出视图文件
     * @param null $tpl
     */
    protected function display($tpl = null)
    {

        if (empty($tpl))
            $tpl = $this->defaultTemplate();
        else
            $tpl = __DIR__."/../".$this->_service->getAppName()."/views/".$tpl;

        $this->view->display($tpl);
    }

    /**
     * 获得默认视图模板
     * @return string
     */
    protected function defaultTemplate()
    {
        return __DIR__."/../".$this->_service->getAppName()."/views/".$this->_service->_group."/".strtolower($this->_service->_controller)."/".$this->_service->_action.".php";
    }

    /**
     * 获取get请求参数
     * @param null $key
     * @param null $default
     * @return null
     */
    protected function getVar($key = null, $default = null)
    {
        return isset($this->_service->_params["$key"])?$this->_service->_params["$key"]:$default;
    }
}