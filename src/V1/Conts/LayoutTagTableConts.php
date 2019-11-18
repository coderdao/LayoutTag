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
    const TABLE_NAME = 'layout_#TABLE_NAME#_tag_index';
    const TABLE_NAME_FLAG = '#TABLE_NAME#';

    const CREATE_TABLE_SQL = "CREATE TABLE `layout_" . self::TABLE_NAME_FLAG . "_tag_index` (
          `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
          `name` varchar(64) NOT NULL DEFAULT '' COMMENT '标签名',
          `tag_code` varchar(30) NOT NULL DEFAULT '' COMMENT '唯一标识代码,唯一.',
          `parent_id` int(11) unsigned DEFAULT 0 COMMENT '父级名称',
          `tag_level` tinyint(2) unsigned NOT NULL DEFAULT 0 COMMENT '从属层级标识',
          `attr` varchar(64) NOT NULL DEFAULT '' COMMENT '标签属性 [ 冗余字段 ]',
          `sortby` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '排序,数值越大越优先',
          `admin_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '添加人id',
          `admin_name` varchar(64) NOT NULL DEFAULT '' COMMENT '添加人名称',
          `created_at` timestamp NULL DEFAULT current_timestamp(),
          `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
          PRIMARY KEY (`id`),
          UNIQUE KEY `idx_name` (`name`) USING BTREE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
}