<?php

namespace CodeArtisan\LaravelTags;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    /**
     * @param   string  $tag
     * @return  CodeArtisan\LaravelTags\Tag
     */
    public static function findOrCreate($tagName): Tag
    {
        if (null === ($tag = self::whereName($tagName)->first())) {
            $tag = self::create(['name' => $tagName]);
        }

        return $tag;
    }
}
