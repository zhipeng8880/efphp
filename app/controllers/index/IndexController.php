<?php
namespace app\controllers\index;

use app\controllers\BaseController;
use app\services\index\NewsService;

/**
 * 默认控制器
 *      等同于：域名/index/index/index
 *      uri中3段的含义分别是 /模块/控制器/方法
 */
class IndexController extends BaseController
{

    /**
     * 功能演示1
     *      创建控制器。
     *      引用控制器父类方法。
     *      视图熟悉赋值。
     *      显示视图。
     */
    public function indexAction()
    {
        //设置视图对象的属性
        $this->view->title   = "EFPHP";
        //引用父类( BaseController->foo )方法
        $this->view->content = $this->foo();

        //显示视图，各段的拼接规则是：/分组名/控制器名/方法名.php
        $this->display("/index/index/index.php");

        //下面是显示视图的省略写法
        //$this->display();

    }

    /**
     * 功能演示 2
     *      控制器接收请求参数
     *      创建服务
     *      调用服务方法
     *      设置视图对象的属性
     *      显示视图
     */
    public function newsListAction()
    {
        //接收请求参数
        $title = $this->getVar("title","my title");

        //创建服务
        $service = new NewsService();

        //调用服务方法
        $result  = $service->getNewsList("title='".$title."'");

        //判断服务结果
        if($result['code']==200)
        {
            $data = $result['data'];

            //设置视图对象的属性
            $this->view->data = $data;

        }else
        {
            //设置视图对象的属性
            $this->view->data = $result;
        }

        //显示视图（简略写法，等同于: /index/index/newslist.php）
        $this->display();
    }
}

