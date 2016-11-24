<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCommodityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_commodity', function (Blueprint $table) {
            $table->increments('id');
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
            // 商品库存
            $table->integer('commodity_stock_number')->default(0);
            // 商品销量
            $table->integer('commodity_sold_number')->default(0);
            // 商品详情
            $table->text('commodity_detail_info')->nullable();
            // 商品简介
            $table->string('commodity_base_info')->nullable();
            // 商品状态
            $table->enum('commodity_disabled',['已上架','已下架']);
            // 商品排序
            $table->integer('commodity_sort')->default(0);
            // 所属专题
            $table->integer('topic_id')->default(0);
            // 所属板块
            $table->integer('plate_id')->default(0);
            // 所属分类
            $table->integer('category_id')->default(0);
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
        Schema::drop('product_commodity');
    }
}
