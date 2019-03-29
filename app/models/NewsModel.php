<?php

namespace app\models;

use lib\Model;

/**
 * 模型，负责数据处理，比如mysql，redis，es，kafka，等
 * Class NewsModel
 * @package app\models
 */
class NewsModel extends Model
{
    //设置mysql的表名
    protected $_table = 'ef_news';

    /**
     * mysql数据库的crud方法均继承于Model，可直接使用。
     */

    //ef_news 表结构如下
    //START TRANSACTION;
    //
    //CREATE TABLE `ef_news` (
    //  `id` int(11) NOT NULL,
    //  `title` varchar(50) CHARACTER SET utf8 NOT NULL
    //) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    //
    //ALTER TABLE `ef_news`
    //  ADD PRIMARY KEY (`id`);
    //
    //ALTER TABLE `ef_news`
    //  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
    //COMMIT;

}