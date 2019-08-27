<?php

namespace Abo\LayoutTag\V0\Model;

use Illuminate\Database\Eloquent\Model;

class LayoutTagRelation extends Model
{
    public $table = 'layout_tag_relation';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /** 不可被批量赋值的属性。 @var array */
    protected $guarded = [];

}
