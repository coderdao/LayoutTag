<?php
/**
 * Function:
 * Description:
 * Abo 2019/9/5 21:16
 * Email: abo2013@foxmail.com
 */

namespace Abo\LayoutTag\V1\Conts;


class LayoutTagRelationTableConts
{
    const TABLE_NAME_FLAG = '#TABLE_NAME#';

    const CREATE_TABLE_SQL = "CREATE TABLE `layout_" . self::TABLE_NAME_FLAG . "_tag_relation` (
      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
      `key_type` varchar(30) NOT NULL COMMENT '关联类型,确认对应表',
      `key_id` int(10) unsigned NOT NULL COMMENT '关联id 与key_type配合使用',
      `tag_id` int(10) unsigned NOT NULL COMMENT 'layout_tag_index 主键 id',
      `name` varchar(64) NOT NULL DEFAULT '' COMMENT '标签名[ 冗余 ]',
      `attr` varchar(64) NOT NULL DEFAULT '' COMMENT '标签属性 [ 冗余字段 ]',
      `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`),
      UNIQUE KEY `udx_key_tag` (`key_type`,`key_id`,`tag_id`) USING BTREE,
      KEY `idx_tagid` (`tag_id`) USING BTREE,
      KEY `idx_name` (`name`) USING BTREE
    ) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4;";
}