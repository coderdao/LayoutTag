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
                $table->string('name',64)->default( '' )->unique()->comment('标签名');
                $table->string('attr',64)->default( '' )->unique()->comment('标签属性 [ 冗余字段 ]');
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->nullable()->useCurrent();
            });
        }else{
            echo 'layout_tag_index 表已存在'."\r\n";
        }

        if ( !Schema::hasTable('layout_tag_relation') ) {
            Schema::create('layout_tag_relation', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string( 'key_type', 30 )->comment('关联类型,确认对应表');
                $table->unsignedInteger('key_id')->comment('关联id 与key_type配合使用');
                $table->unsignedInteger('tag_id')->comment('layout_tag_index 主键 id');
                $table->string('name',64)->default( '' )->unique()->comment('标签名[ 冗余 ]');
                $table->string('attr',64)->default( '' )->unique()->comment('标签属性 [ 冗余字段 ]');
                $table->timestamp('created_at')->nullable()->useCurrent();
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
