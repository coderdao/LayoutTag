<?php
/**
 * Function:
 */

namespace Abo\LayoutTag\V0\Repository;


use Abo\Generalutil\V1\Repositories\BaseRepository;
use Abo\LayoutTag\V0\Model\LayoutTagRelation;
use Illuminate\Database\Eloquent\Model;

class LayoutTagRelationRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct( new LayoutTagRelation() );
    }

    /**
     * 某实体的关联标签列表
     * @method LayoutTagRelationRepository::listRelationTags
     * @param string $keyType 实体类型
     * @param int $keyId      实体id
     * @return array          关联标签列表
     * @throws \Exception
     */
    public function listRelationTags( string $keyType, int $keyId )
    {
        // if ( !$keyType && ( !$keyId && !$tagName ) ) { throw new \Exception( '暂无更多信息', -100 ); }
        if ( !$keyType || !$keyId ) { throw new \Exception( '暂无更多信息', -100 ); }

        $SearchModel = $this->Model->select( [ 'tag_id', 'name' ] )
            ->where( 'key_type', '=', $keyType );
        if ( $keyId ) {
            $SearchModel = $SearchModel->where( 'key_id', '=', $keyId );
        }

        $SearchModel = $SearchModel->get();
        if ( !$SearchModel ) {
            return [];
        }

        return $SearchModel->toArray();
    }

    /**
     * 保存 ( 增/改 ) 标签信息
     * @method LayoutTagRelationRepository::saveTagRelation
     * @param string $keyType 关联类型
     * @param int $keyId      关联id
     * @param string $tagName        标签名
     * @return bool|int|mixed 保存个数
     * @throws \Exception
     */
    public function saveTagRelation( string $keyType, int $keyId, $tagName )
    {
        if ( !$keyType || !$keyId || !$tagName ) {
            return false;
        }

        // 寻找 / 添加标签
        $tagArray = ( new LayoutTagRepository() )->findOrCreateTags( $tagName );
        if ( !$tagArray ) { throw new \Exception( '未成功添加标签', -100 ); }

        // 保存标签关系
        $i2Count = 0;
        foreach ( $tagArray as $k2TagName => $v2TagId ) {
            if ( !$k2TagName || !$v2TagId ) { continue; }
            $data2Insert = [
                'key_type' => $keyType,
                'key_id' => $keyId,
                'tag_id' => $v2TagId,
                'name' => $k2TagName,
            ];

            $i2Count += self::duplicateKeyInsert( $data2Insert, $this->Model->getTable() );
        }

        return $i2Count;
    }
}