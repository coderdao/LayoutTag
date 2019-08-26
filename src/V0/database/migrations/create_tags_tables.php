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
                $table->string('name',64)->default( '' )->comment('标签名');
                $table->timestamps()->default( \Illuminate\Support\Facades\DB::raw( 'CURRENT_TIMESTAMP' ) );
            });
        }else{
            echo 'tag_index 表已存在'."\r\n";
        }

        if ( !Schema::hasTable('tag_relation') ) {
            Schema::create('tag_relation', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->unsignedInteger('tag_id')->comment('tag_index 主键 id');
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
        Schema::dropIfExists('taggables');
        Schema::dropIfExists('tags');
    }
}
