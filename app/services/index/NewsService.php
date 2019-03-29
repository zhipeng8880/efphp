<?php

namespace app\services\index;

use app\models\NewsModel;
use lib\Service;

/**
 * 服务：
 *      向控制器提供方法和业务逻辑结果，
 *      在方法内实现具体的业务逻辑，
 *      通常需要引用模型层完成数据本身操作。
 *
 */
class NewsService extends Service
{
    /**
     * 示例方法：
     *      获取新闻列表
     * 说明：
     *      根据条件返回新闻列表。
     *      调用方应该对返回结果的code进行判断。
     *
     * @param $str
     * @return array
     */
    public function getNewsList($str)
    {
        $newsModel = new NewsModel();
        $result = $newsModel->find($str);
        return $result;
    }

}