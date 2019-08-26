<?php

namespace Abo\LayoutTag;

use Illuminate\Support\ServiceProvider;

class TagsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $timestamp = date('Y_m_d_His');
        $this->publishes(
            [ __DIR__.'/V0/database/migrations/create_tags_tables.php' => database_path("migrations/{$timestamp}_create_tags_tables.php"), ]
            , 'layout-tags');
    }
}
