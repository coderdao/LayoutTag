<?php
/**
 * Function:
 * Description:
 * Abo 2019/11/17 16:51
 * Email: abo2013@foxmail.com
 */
namespace Abo\LayoutTag\Console\Logic\Common;

use Abo\Generalutil\V1\Utils\FileUtil;
use Abo\LayoutTag\V1\Conts\LayoutTagRelationTableConts;
use Abo\LayoutTag\V1\Conts\LayoutTagTableConts;

class CommandAutoCreateClientLogic
{
    protected $prefix, $tableIndexName, $logicIndexName, $tableRelationName, $logicRelationName;

    public function __construct( $prefix )
    {
        $CommonLogic = new CommonLogic();

        $this->prefix = $prefix;
        $this->tableIndexName = str_replace( LayoutTagTableConts::TABLE_NAME_FLAG, $prefix, LayoutTagTableConts::TABLE_NAME );
        $this->tableRelationName = str_replace( LayoutTagRelationTableConts::TABLE_NAME_FLAG, $prefix, LayoutTagRelationTableConts::TABLE_NAME );

        $this->logicIndexName = $CommonLogic->tableName2ClassName( $this->tableIndexName );
        $this->logicRelationName = $CommonLogic->tableName2ClassName( $this->tableRelationName );
    }

    /** 创建 模型 */
    public function createModelLogic()
    {
        shell_exec( 'php artisan make:model Model/LayoutTag/'.$this->logicIndexName );
        shell_exec( 'php artisan make:model Model/LayoutTag/'.$this->logicRelationName );

        $createIndexStuFileConfig = [
            'stubPath' => __DIR__.'/../../stubs/Model/LayoutTag.stub',
            'createClassPath' => app_path( 'Model/LayoutTag/'. $this->logicIndexName .'.php' ),
            'targetArray' => [ 'DummyClass', 'DummyTable' ],
            'replaceArray' => [ $this->logicIndexName, $this->tableIndexName ],
        ];
        $ret2CreateIndexMoel = ( new FileUtil() )->createStubFile( $createIndexStuFileConfig );

        $createRelationStuFileConfig = [
            'stubPath' => __DIR__.'/../../stubs/Model/LayoutTagRelation.stub',
            'createClassPath' => app_path( 'Model/LayoutTag/'. $this->logicRelationName .'.php' ),
            'targetArray' => [ 'DummyClass', 'DummyTable' ],
            'replaceArray' => [ $this->logicRelationName, $this->tableRelationName ],
        ];
        $ret2CreateRelationModel = ( new FileUtil() )->createStubFile( $createRelationStuFileConfig );

        echo "\r\n创建 数据同步逻辑:" . $ret2CreateIndexMoel . ' || ' . $ret2CreateRelationModel;
        return true;
    }

    /** 创建 数据操作层 */
    public function createRepositoryLogic()
    {
        $IndexRepository = $this->logicIndexName . 'Repository';
        $RelationRepository = $this->logicRelationName . 'Repository';

        shell_exec( 'php artisan make:model Repository/LayoutTag/' . $IndexRepository );
        shell_exec( 'php artisan make:model Repository/LayoutTag/' . $RelationRepository );

        $createIndexStuFileConfig = [
            'stubPath' => __DIR__.'/../../stubs/Repository/LayoutTagRepository.stub',
            'createClassPath' => app_path( 'Repository/LayoutTag/'. $IndexRepository .'.php' ),
            'targetArray' => [ 'DummyClass', 'DummyModel' ],
            'replaceArray' => [ $IndexRepository, $this->logicIndexName ],
        ];
        $ret2CreateIndexRepository = ( new FileUtil() )->createStubFile( $createIndexStuFileConfig );

        $createRelationStuFileConfig = [
            'stubPath' => __DIR__.'/../../stubs/Repository/LayoutTagRelationRepository.stub',
            'createClassPath' => app_path( 'Repository/LayoutTag/'. $RelationRepository .'.php' ),
            'targetArray' => [ 'DummyClass', 'DummyModel' ],
            'replaceArray' => [ $RelationRepository, $this->logicIndexName ],
        ];
        $ret2CreateRelationRepository = ( new FileUtil() )->createStubFile( $createRelationStuFileConfig );

        echo "\r\n创建 数据同步逻辑:" . $ret2CreateIndexRepository . ' || ' . $ret2CreateRelationRepository;
        return true;
    }
}