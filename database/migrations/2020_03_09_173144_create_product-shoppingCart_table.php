<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductShoppingCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_shoppingCart', function(Blueprint $table){
          $table->timestamps();
          // $table->bigIncrements('id');
          $table->bigInteger('product_id')->unsigned();
          $table->bigInteger('shoppingCart_id')->unsigned();
          $table->primary(['product_id', 'shoppingCart_id']);
          $table->foreign('product_id')
          ->references('id')->on('products');
          // ->onDelete('cascade');
          $table->foreign('shoppingCart_id')
          ->references('id')->on('shoppingCarts');
          // ->onDelete('cascade');
          $table->boolean('status')->default($value = true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_shoppingCart');
    }
}
