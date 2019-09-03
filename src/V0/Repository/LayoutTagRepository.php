<?php
namespace Abo\LayoutTag\V0\Repository;

use Abo\Generalutil\V1\Repositories\BaseRepository;
use Abo\Generalutil\V1\Utils\AnalysisUtil;
use Abo\LayoutTag\V0\Model\LayoutTag;
use Illuminate\Database\Eloquent\Model;

class LayoutTagRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct( new LayoutTag() );
    }

    /**
     * 自动添加 单个/一组 标签
     * @param string|array $tag 标签 ( 单个|一组 )
     * @return array [ '标签名' => 对应ids ]
     * @throws \Exception
     */
    public function findOrCreateTags( $tag )
    {
        $ret2Return = [];
        if( !$tag ){ return $ret2Return; }

        if ( is_string( $tag ) ) {
            $tagInfo = $this->insertTag( $tag ); // list( $tagName, $tagId ) = $this->insertTag( $tag );
            $ret2Return[ $tagInfo[0] ] = $tagInfo[1];
        }elseif ( is_array( $tag ) ) {
            $ret2Return = $this->insertTagArray( $tag );
        }

        return $ret2Return;
    }

    private function insertTagArrayV2( array $tagName )
    {
        $tagName = array_unique( array_filter( $tagName ) );
        if ( !$tagName ) { throw new \Exception( '标签名必填', -100 ); }

        // 重复的 就直接取id ~ 1ms 左右,看数据库波动
        $ret2ExistTagId = $this->Model->whereIn( 'name', $tagName )->pluck( 'id', 'name' );
        if ( $ret2ExistTagId ){
            $ret2Return = $ret2ExistTagId->toArray();
            $tagName = array_diff( $tagName, array_keys( $ret2Return ) ); // 不存在标签留下一步新增
        }

        // 组织批量插入数组
        foreach ( $tagName as $v2Tag ) {
            $data2Insert[] = [ 'name' => trim( $v2Tag ) ];
        }
        $ret2ExistTagId = $this->Model->insert( $data2Insert );

        // 获取全部 tag & id
        $ret2Return = $this->Model->whereIn( 'name', $tagName )->pluck( 'id', 'name' )->toArray();

        return $ret2Return;
    }

    /**
     * 添加单个 标签
     * @param string $tagName 标签名( 单个 )
     * @return int|mixed
     * @throws \Exception
     */
    private function insertTag( string $tagName = '' )
    {
        $tagName = trim( $tagName );
        if ( !$tagName ) { throw new \Exception( '标签名必填', -100 ); }

        // ( 是否异常在标签 / 无则添加 ) 返回 id
        /** @var $this->Model \Illuminate\Database\Query\Builder */
        $ret2ExistTagId = $this->Model->where( 'name', $tagName )->value('id' );

        if ( !$ret2ExistTagId ) {
            $data2Insert = [ 'name' => trim( $tagName ) ];
            $ret2ExistTagId = $this->Model->insertGetId( $data2Insert );
        }

        return [ $tagName, $ret2ExistTagId ];

    }

    /**
     * 添加标签数组
     * @param array $tagName 标签名 ( 数组 )
     * @return array
     * @throws \Exception
     */
    private function insertTagArray( array $tagName )
    {
        $tagName = array_unique( array_filter( $tagName ) );
        if ( !$tagName ) { throw new \Exception( '标签名必填', -100 ); }

        // 重复的 就直接取id ~ 1ms 左右,看数据库波动
        $ret2ExistTagId = $this->Model->whereIn( 'name', $tagName )->pluck( 'id', 'name' );
        if ( $ret2ExistTagId ){
            $ret2Return = $ret2ExistTagId->toArray();
            $tagName = array_diff( $tagName, array_keys( $ret2Return ) ); // 不存在标签留下一步新增
        }

        foreach ( $tagName as $v2Tag ) {
            $tagInfo = $this->insertTag( $v2Tag ); // list( $tagName, $tagId ) = $this->insertTag( $tag );
            $ret2Return[ $tagInfo[0] ] = $tagInfo[1];
        }

        return $ret2Return;
    }
}