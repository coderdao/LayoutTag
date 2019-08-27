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

    public function insertTag( string $tagName = '' )
    {


        self::duplicateKeyInsert( $this->Model->getTable() );
    }
}