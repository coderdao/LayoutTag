<?php
/**
 * Function:
 * Description:
 * Abo 2019/9/5 21:09
 * Email: abo2013@foxmail.com
 */

namespace Abo\LayoutTag\Console;

use Abo\LayoutTag\Console\Logic\Common\CommandAutoCreateClientLogic;
use Illuminate\Console\Command;
use Abo\LayoutTag\Console\Logic\DataBase\CreateTableLogic;

class CreateLayoutTagCommand extends Command
{
    /** The name and signature of the console command. @var string */
    protected $signature = 'layout_tag:create {name}';

    protected $name = 'layout_tag:create';

    /** The console command description. @var string */
    protected $description = 'create Layout Tag Logic';

    /** Execute the console command. @return mixed */
    public function handle()
    {
        // parent::handle(); // 创建文件
        $this->createAppClientCommands();
    }

    protected function createAppClientCommands()
    {
        $prefix = trim($this->argument('name'));
        
        CreateTableLogic::createTable( $prefix ); // 创建tag 表

        $CommandAutoCreateClientLogic = new CommandAutoCreateClientLogic( $prefix );

        $CommandAutoCreateClientLogic->createModelLogic(); // 同步 模型 添加
        $CommandAutoCreateClientLogic->createRepositoryLogic(); // 同步 数据处理层 添加


//        $CommandAutoClientLogic = new CommandAutoClientLogic( $prefix );
//
//        $CommandAutoClientLogic->setTableSetting();         // 触发器,change_log表设置
//        $CommandAutoClientLogic->createAppClientCommands(); // 同步命令添加
//        $CommandAutoClientLogic->createAppClientLogic();    // 同步逻辑添加
//        $CommandAutoClientLogic->createAppClientRepository(); // 同步模型操作添加

        return '完成客户端创建';
    }

}