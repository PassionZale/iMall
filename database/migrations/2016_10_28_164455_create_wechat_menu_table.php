<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_menu', function (Blueprint $table) {
            $table->increments('id');
            // 菜单名称
            $table->string('name');
            /**
             * view : 跳转视图
             * click : 点击推事件
             * none : 无事件的一级菜单
             */
            $table->enum('type', ['view', 'click', 'none']);
            // view 类型需要设置的跳转链接
            $table->string('url');
            // click 类型需要设置的关键词
            $table->string('key');
            // 一级菜单
            $table->integer('parent_button')->default(0);
            // 菜单排序
            $table->integer('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wechat_menu');
    }
}
