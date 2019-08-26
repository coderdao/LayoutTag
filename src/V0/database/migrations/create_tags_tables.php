<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('tag_index') ) {
            Schema::create('tag_index', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('name');
                $table->timestamps();
            });
        }else{
            echo 'tag_index 表已存在'."\r\n";
        }

        if ( !Schema::hasTable('tag_relation') ) {
            Schema::create('tag_relation', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->increments('tag_id')->unsigned();
                $table->morphs('taggable');
            });
        }else{
            echo 'tag_relation 表已存在'."\r\n";
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taggables', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
        });
        Schema::dropIfExists('taggables');
        Schema::dropIfExists('tags');
    }
}
