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
        if ( !Schema::hasTable('layout_tag_index') ) {
            Schema::create('layout_tag_index', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('name',64)->default( '' )->comment('标签名');
                $table->timestamps()->default( \Illuminate\Support\Facades\DB::raw( 'CURRENT_TIMESTAMP' ) );
            });
        }else{
            echo 'layout_tag_index 表已存在'."\r\n";
        }

        if ( !Schema::hasTable('layout_tag_relation') ) {
            Schema::create('layout_tag_relation', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->unsignedInteger('tag_id')->comment('layout_tag_index 主键 id');
            });
        }else{
            echo 'layout_tag_relation 表已存在'."\r\n";
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layout_tag_relation');
        Schema::dropIfExists('layout_tag_index');
    }
}
