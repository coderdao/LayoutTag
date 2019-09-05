<?php
/**
 * Function:
 * Description:
 * Abo 2019/9/5 21:18
 * Email: abo2013@foxmail.com
 */

namespace Abo\LayoutTag\Console\Logic\DataBase;


class CreateTableLogic
{
    /** 设置 同步表 & 触发器 */
    public function setTableSetting( string $tableName )
    {
        if ( !$tableName ) {
            return false;
        }

        config( [ 'database.connections.mysql.options' => [ \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true ] ] );

        // $this->clearExistTableAndTrigger($tableName);
        $ret2CreateChangeLogTable = $this->createChangeLogTable($tableName);
        // $ret2SetTableTrigger = $this->setTableTrigger($tableName);

        return $ret2CreateChangeLogTable;
    }

    /** 清除 同步表 & 触发器 */
    protected function clearExistTableAndTrigger( string $tableName = '' )
    {
        if ( !$tableName ) {
            return false;
        }

        $sql = str_replace( BptConst::TABLE_NAME_FLAG, $tableName, BptConst::TABLE_TRIGGER_EXIST_CLEAR );
        $statements = explode( ';', $sql );

        foreach ( $statements as $v2Statements ) {
            DB::statement( $v2Statements );
        }

        return true;
    }

    /** 创建数据变更记录表 */
    protected function createChangeLogTable( string $tableName = '' )
    {
        if ( !$tableName ) {
            return false;
        }

        $sql = str_replace( BptConst::TABLE_NAME_FLAG, $tableName, BptConst::CREATE_CHANGE_LOG_TABLE );
        return DB::statement( $sql );
    }

    /** 给 原数据变 设置触发器 */
    protected function setTableTrigger( string $tableName = '' )
    {
        if ( !$tableName ) {
            return false;
        }

        $sql2SetInsertTrigger = str_replace( BptConst::TABLE_NAME_FLAG, $tableName, BptConst::TRIGGER_INSERT );
        $ret2SetInsertTrigger = DB::statement( $sql2SetInsertTrigger );

        $sql2SetUpdateTrigger = str_replace( BptConst::TABLE_NAME_FLAG, $tableName, BptConst::TRIGGER_UPDATE );
        $ret2SetUpdateTrigger = DB::statement( $sql2SetUpdateTrigger );

        $sql2SetDeleteTrigger = str_replace( BptConst::TABLE_NAME_FLAG, $tableName, BptConst::TRIGGER_DELETE );
        $ret2SetDeleteTrigger = DB::statement( $sql2SetDeleteTrigger );

        return ( $ret2SetInsertTrigger && $ret2SetUpdateTrigger && $ret2SetDeleteTrigger );
    }
}