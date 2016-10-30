<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat', function (Blueprint $table) {
            $table->increments('id');
            // 名称
            $table->string('wechat_name');
            // 微信号
            $table->string('wechat_account');
            // 原始ID
            $table->string('wechat_original_account');
            // App Id
            $table->string('app_id');
            // App Secret
            $table->string('app_secret');
            // 安全模式必填
            $table->string('encodingaeskey');
            // 校验token
            $table->string('token');
            // 服务器地址(自动生成)
            $table->string('url');
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
        Schema::drop('wechat');
    }
}
