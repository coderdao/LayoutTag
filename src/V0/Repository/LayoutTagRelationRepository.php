<?php
/**
 * Function:
 * Description:
 * Abo 2019/8/27 17:34
 * Email: abo2013@foxmail.com
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


}