<?php
namespace lib;

/**
 * 框架入口文件，负责加载配置、创建路由、转发请求和加载控制器，
 * Class Service
 * @package lib
 */
class Start
{
    protected static $_instance = null; //单例实例
    protected static $_reg = array();   //注册全局变量

    public $_errors = [];   //报错信息
    public $_group = "";   //请求的分组
    public $_controller = "";   //请求的控制器
    public $_action = "";   //请求的方法
    public $_params = [];   //请求的参数（数组）
    public $_paramsStr = '';   //请求的参数（字符串）
    public static $_config = [];   //系统配置
    public $appName = "";   //应用目录

    /**
     * 设置配置文件，设置系统配置 $_config
     * @param $configFile
     */
    public function setConfigFile($configFile)
    {
        $config = [];
        /** @noinspection PhpIncludeInspection */
        include_once $configFile;
        self::$_config = $config;
    }

    public function getConfig()
    {
        return self::$_config;
    }


    /**
     * 设置应用目录名称
     * @param $appName
     */
    public function setAppName($appName)
    {
        $this->appName = $appName;
    }

    /**
     * 读取应用目录名称
     * @return string
     */
    public function getAppName()
    {
        return $this->appName;
    }

    /**
     * 获取service 单例实例
     * @return Start|null
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * 自动加载+创建路由
     * @return $this
     */
    public function boot()
    {
        spl_autoload_register(__NAMESPACE__ .'\Start::autoloader');

        $_SERVER['PATH_INFO'] = empty($_SERVER['PATH_INFO'])?'':$_SERVER['PATH_INFO'];
        //确定控制器组、控制器、方法、参数
        $pathInfoArray  = explode("/",$_SERVER['PATH_INFO']);
        $paramsArray    = array_slice($pathInfoArray,4);
        $params = [];

        for($i=0;$i<count($paramsArray);$i=$i+2)
            $params[$paramsArray[$i]] = isset($paramsArray[$i+1])?$paramsArray[$i+1]:'';


        $this->_group      = strtolower(empty($pathInfoArray[1])?"index":$pathInfoArray[1]);
        $this->_controller = ucfirst(strtolower(empty($pathInfoArray[2])?"index":$pathInfoArray[2]));
        $this->_action     = empty($pathInfoArray[3])?"index":$pathInfoArray[3];
        $this->_params     = $params;
        $this->_paramsStr  = $this->createParamsStr();
        return $this;
    }

    /**
     * 创建GET请求的参数字符串
     * @return string
     */
    private function createParamsStr()
    {
        $str = '';

        if(empty($this->_params))
            return '';
        else
        {
            foreach ($this->_params as $k => $v)
            {
                $str .= $k."/".$v."/";
            }
            return trim($str,"/");
        }
    }

    /**
     *  转发路由
     */
    public function dispatch()
    {
        $controllerName = "\\{$this->appName}\controllers\\".$this->_group."\\".$this->_controller."Controller";

        $controller = new $controllerName($this);

        if (is_object($controller)) {
            $func = array($controller, $this->_action."Action");
            if (!is_callable($func, false)) {
                echo "找不到方法:{$this->_action}";
                exit;
            }
            call_user_func($func);
        }

    }

    /**
     * 自动加来类文件
     * @param $className
     * @return bool
     */
    public function autoloader($className) {

        if (class_exists($className, false) || interface_exists($className, false)) {
            return true;
        }

        //自动加载库文件、控制器、模型、服务
        $str = str_replace("\\","/",$className);
        $classFile=__DIR__."/../".$str.".php";

        if (file_exists($classFile))
            /** @noinspection PhpIncludeInspection */
            include $classFile;
        else
        {
            echo "自动加载失败，工程不存在：$className";
            if(self::$_config['_debug']==true){
                echo "<br>文件路径：".$classFile;
                try
                {
                    /** @noinspection PhpIncludeInspection */
                    include $classFile;
                }catch (\Exception $e)
                {
                    echo $e->getMessage();
                }
            }

            exit;
        }

        return (class_exists($className, false) || interface_exists($className, false));
    }

}