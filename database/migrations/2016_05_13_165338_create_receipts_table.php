<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('order_id'); # 订单ID
            $table->string('receiver');     # 收件人
            $table->string('title',80);     # 发票抬头
            $table->string('address',128);  # 邮寄地址
            $table->string('code',15);      # 邮编
            $table->string('phone',15);     # 电话号码
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
        Schema::drop('receipts');
    }
}
