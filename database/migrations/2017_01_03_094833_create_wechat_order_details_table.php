<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid');
            // 订单ID
            $table->integer('order_id');
            // 商品ID
            $table->integer('commodity_id');
            // 购买数量
            $table->integer('buy_number');
            // 商品名称
            $table->string('commodity_name');
            // 商品图片
            $table->string('commodity_img')->nullable();
            // 商品编号
            $table->string('commodity_number')->nullable();
            // 商品原价
            $table->float('commodity_original_price')->default(0.00);
            // 商品现价
            $table->float('commodity_current_price')->default(0.00);
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
        Schema::drop('wechat_order_details');
    }
}
