<?php
/**
 * Function:
 * Description:
 * Abo 2019/11/17 16:46
 * Email: abo2013@foxmail.com
 */
namespace Abo\LayoutTag\Console\Logic\Common;

use Abo\Generalutil\V1\Utils\StringUtil;

class CommonLogic
{
    /** 表名 转 类名 */
    public function tableName2ClassName( $tableName )
    {
        $StringUtil = new StringUtil();
        return ucfirst( $StringUtil->camelize( $tableName ) );
    }
}