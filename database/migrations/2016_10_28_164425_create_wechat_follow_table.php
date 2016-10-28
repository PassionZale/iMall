<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatFollowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_follow', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid');
            $table->string('nickname');
            $table->enum('sex', ['未知', '男', '女']);
            $table->string('language');
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->string('headimgurl');
            $table->string('remark');
            $table->integer('groupid');
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
        Schema::drop('wechat_follow');
    }
}
