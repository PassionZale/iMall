<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPlateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_plate', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plate_title');
            $table->string('plate_img');
            $table->integer('plate_sort')->default(0);
            $table->enum('disabled',['显示','隐藏']);
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
        Schema::drop('product_plate');
    }
}
