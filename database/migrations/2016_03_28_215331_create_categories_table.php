<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('categories', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id');
            $table->unsignedTinyInteger('level');
            $table->string('name', 80);
            $table->string('node', 1024);
            $table->string('tab_name',40);
            $table->decimal('ratio',2,1);

            $table->index('parent_id');
            $table->index('name');
            $table->index('node');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('categories');
    }

}
