<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_config', function (Blueprint $table) {
            $table->increments('id');
            // 商城名称
            $table->string('config_name');
            // 基础运费
            $table->float('config_freight')->default(0.00);
            // 免运费最低消费额
            $table->float('config_free')->nullable();
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
        Schema::drop('shop_config');
    }
}
