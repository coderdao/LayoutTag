<?php
namespace Abo\LayoutTag\V0\Repository;

use Abo\Generalutil\V1\Repositories\BaseRepository;
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
     */
    public function insertTags( $tag )
    {
        $ret2Return = [];
        if( !$tag ){ return $ret2Return; }

        if ( is_string( $tag ) ) {
            $tagInfo = $this->insertTag( $tag ); // list( $tagName, $tagId ) = $this->insertTag( $tag );
            $ret2Return[ $tagInfo[0] ] = $tagInfo[1];
        }elseif ( is_array( $tag ) ) {
            foreach ( $tag as $v2Tag ) {
                $tagInfo = $this->insertTag( $tag ); // list( $tagName, $tagId ) = $this->insertTag( $tag );
                $ret2Return[ $tagInfo[0] ] = $tagInfo[1];
            }
        }

        return $ret2Return;
    }

    /**
     * 添加单个 标签
     * @param string $tagName 标签名
     * @return int|mixed
     * @throws \Exception
     */
    private function insertTag( string $tagName = '' )
    {
        $tagName = trim( $tagName );
        if ( !$tagName ) { throw new \Exception( '标签名必填', -100 ); }

        /**
         *self::duplicateKeyInsert( [ 'name' => trim( $tagName ) ], $this->Model->getTable() ); // 需要测试 返回更新 / 插入id
         */

        // ( 是否异常在标签 / 无则添加 ) 返回 id
        /** @var $this->Model \Illuminate\Database\Query\Builder */
        $ret2ExistTagId = $this->Model->where( 'name', $tagName )->value('id' );

        if ( !$ret2ExistTagId ) {
            $data2Insert = [ 'name' => trim( $tagName ) ];
            $ret2ExistTagId = $this->Model->insertGetId( $data2Insert );
        }

        return [ $tagName, $ret2ExistTagId ];
    }
}