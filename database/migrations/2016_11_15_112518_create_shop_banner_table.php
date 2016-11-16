<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_banner', function (Blueprint $table) {
            $table->increments('id');
            // banner title
            $table->string('title');
            // img url
            $table->string('img_url')->nullable();
            // rediret url
            $table->string('redirect_url')->nullable();
            // 排序
            $table->integer('sort')->default(0);
            // 是否显示
            $table->enum('disabled', ['显示', '隐藏']);
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
        Schema::drop('shop_banner');
    }
}
