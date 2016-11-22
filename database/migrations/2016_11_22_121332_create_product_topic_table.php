<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_topic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('topic_title');
            $table->string('topic_img');
            $table->integer('topic_sort')->default(0);
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
        Schema::drop('product_topic');
    }
}
