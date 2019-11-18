<?php
/**
 * Function: 创建 标签系列表结构
 * Description:
 * Abo 2019/9/5 21:18
 * Email: abo2013@foxmail.com
 */

namespace Abo\LayoutTag\Console\Logic\DataBase;


use Abo\LayoutTag\V1\Conts\LayoutTagRelationTableConts;
use Abo\LayoutTag\V1\Conts\LayoutTagTableConts;

class CreateTableLogic
{
    /** 创建数据变更记录表 */
    public static function createTable( string $tableName = '' )
    {
        if ( !$tableName ) { return false; }

        try {
            \DB::beginTransaction();

            $createLayoutTagTableSql = str_replace(LayoutTagTableConts::TABLE_NAME_FLAG, $tableName, LayoutTagTableConts::CREATE_TABLE_SQL);
            \DB::statement($createLayoutTagTableSql);

            $createLayoutTagRelationTableSql = str_replace(LayoutTagRelationTableConts::TABLE_NAME_FLAG, $tableName, LayoutTagRelationTableConts::CREATE_TABLE_SQL);
            \DB::statement($createLayoutTagRelationTableSql);

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            return '[ 失败 ]数据表-创建失败';
        }

        return '[ 成功 ]数据表-创建成功';
    }

}