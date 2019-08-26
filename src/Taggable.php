<?php

namespace Abo\LayoutTag;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Taggable
{
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * @param array $tags Array of tags as string or IDs
     *
     * @return void
     */
    public function syncTags(array $tags): void
    {
        $tags = array_map(function ($item) {
            if (is_int($item)) {
                return Tag::find($item)->id ?? null;
            }

            $tag = Tag::findOrCreate($item);

            return $tag->id;
        }, $tags);

        $tags = array_filter($tags);

        $this->tags()->sync($tags);
    }
}
