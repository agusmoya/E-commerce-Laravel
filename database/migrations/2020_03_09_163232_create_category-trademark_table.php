<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTrademarkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_trademark',  function (Blueprint $table) {
          $table->timestamps();
          $table->bigInteger('category_id')->unsigned();
          $table->bigInteger('trademark_id')->unsigned();
          $table->foreign('category_id')
          ->references('id')->on('categories')
          ->onDelete('cascade');
          $table->foreign('trademark_id')
          ->references('id')->on('trademarks')
          ->onDelete('cascade');
          $table->primary(['category_id', 'trademark_id']);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('category_trademark');

    }
}
