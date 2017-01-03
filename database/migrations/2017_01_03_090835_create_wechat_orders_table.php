<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid');
            // 订单编号
            $table->string('order_number');
            // 支付状态
            $table->enum('pay_status', ['未支付', '已支付']);
            // 订单总价
            $table->float('order_amount')->default(0.00);
            // 商品总价
            $table->float('commodity_amount')->default(0.00);
            // 运费总价
            $table->float('freight_amount')->default(0.00);
            // 配送状态
            $table->enum('ship_status', ['未发货', '已发货', '已收货']);
            // 物流公司
            $table->string('ship_name')->nullable();
            // 物流单号
            $table->string('ship_number')->nullable();
            // 收货人姓名
            $table->string('name');
            // 收货人联系电话
            $table->string('phone');
            // 省
            $table->string('province');
            // 市
            $table->string('city');
            // 区
            $table->string('district')->nullable();
            // 详细地址
            $table->string('address');
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
        Schema::drop('wechat_orders');
    }
}
