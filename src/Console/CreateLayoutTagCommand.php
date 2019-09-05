<?php
/**
 * Function:
 * Description:
 * Abo 2019/9/5 21:09
 * Email: abo2013@foxmail.com
 */

namespace Abo\LayoutTag\Console;


class CreateLayoutTagCommand
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
        $CommandAutoClientLogic = new CommandAutoClientLogic( trim($this->argument('name')) );

        $CommandAutoClientLogic->setTableSetting();         // 触发器,change_log表设置
        $CommandAutoClientLogic->createAppClientCommands(); // 同步命令添加
        $CommandAutoClientLogic->createAppClientLogic();    // 同步逻辑添加
        $CommandAutoClientLogic->createAppClientRepository(); // 同步模型操作添加

        return '完成客户端创建';
    }
}