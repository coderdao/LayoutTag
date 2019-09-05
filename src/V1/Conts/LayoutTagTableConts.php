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

    const TABLE_TRIGGER_EXIST_CLEAR = "DROP TRIGGER IF EXISTS `trig_" . self::TABLE_NAME_FLAG . "_detele`;
        DROP TRIGGER IF EXISTS `trig_" . self::TABLE_NAME_FLAG . "_insert`;
        DROP TRIGGER IF EXISTS `trig_" . self::TABLE_NAME_FLAG . "_update`;
        DROP TABLE IF EXISTS `" . self::TABLE_NAME_FLAG . "_change_log`;";

    const TRIGGER_INSERT = "CREATE TRIGGER `trig_" . self::TABLE_NAME_FLAG . "_insert` AFTER INSERT ON `" . self::TABLE_NAME_FLAG . "` FOR EACH ROW "
    ."INSERT INTO " . self::TABLE_NAME_FLAG . "_change_log ( `type`, `change_id` ) VALUES ( 'INSERT', NEW.id )";
    const TRIGGER_UPDATE = "CREATE TRIGGER `trig_" . self::TABLE_NAME_FLAG . "_update` AFTER UPDATE ON `" . self::TABLE_NAME_FLAG . "` FOR EACH ROW "
    ."INSERT INTO " . self::TABLE_NAME_FLAG . "_change_log ( `type`, `change_id` ) VALUES ( 'UPDATE', NEW.id )";
    const TRIGGER_DELETE = "CREATE TRIGGER `trig_" . self::TABLE_NAME_FLAG . "_detele` AFTER DELETE ON `" . self::TABLE_NAME_FLAG . "` FOR EACH ROW"
    ."INSERT INTO " . self::TABLE_NAME_FLAG . "_change_log ( `type`, `change_id` ) VALUES ( 'DELETE', OLD.id )";

    const CREATE_CHANGE_LOG_TABLE = "
        CREATE TABLE IF NOT EXISTS `" . self::TABLE_NAME_FLAG . "_change_log` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `type` varchar(255) DEFAULT NULL,
          `change_id` int(11) unsigned DEFAULT 0,
          `sync_status` tinyint(1) unsigned DEFAULT 0 COMMENT '同步状态: 0,未同步 1,已同步',
          `created_at` timestamp NULL DEFAULT current_timestamp(),
          PRIMARY KEY (`id`),
          KEY `idx_created_at` (`created_at`) USING BTREE,
          KEY `idx_sync_status` (`sync_status`) USING BTREE,
          KEY `idx_type` (`type`) USING BTREE,
          KEY `idx_change_id` (`change_id`) USING BTREE
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;";
}