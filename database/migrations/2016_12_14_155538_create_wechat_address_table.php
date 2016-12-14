<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_address', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid');
            $table->string('name');
            $table->string('phone');
            $table->string('province');
            $table->string('city');
            $table->string('district')->nullable();
            $table->string('address');
            $table->boolean('defaulted')->default(FALSE);
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
        Schema::drop('wechat_address');
    }
}
