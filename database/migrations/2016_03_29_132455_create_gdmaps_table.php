<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGdmapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gdmaps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address');
            $table->string('category');
            $table->string('name',40);
            $table->string('office');
            $table->string('sku');
            $table->integer('user_id');
            $table->integer('yun_id');
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
        Schema::drop('gdmaps');
    }
}
