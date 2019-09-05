<?php
/**
 * Function:
 * Description:
 * Abo 2019/9/5 21:16
 * Email: abo2013@foxmail.com
 */

namespace Abo\LayoutTag\V1\Conts;


class LayoutTagTableConts
{
    const TABLE_NAME_FLAG = '#TABLE_NAME#';

    const CREATE_TABLE_SQL = "CREATE TABLE `" . self::TABLE_NAME_FLAG . "_tag_index` (
      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
      `name` varchar(64) NOT NULL DEFAULT '' COMMENT '标签名',
      `attr` varchar(64) NOT NULL DEFAULT '' COMMENT '标签属性 [ 冗余字段 ]',
      `admin_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加人id',
      `admin_name` varchar(64) NOT NULL DEFAULT '' COMMENT '添加人名称',
      `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
      `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`),
      UNIQUE KEY `idx_name` (`name`) USING BTREE
    ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;";
}