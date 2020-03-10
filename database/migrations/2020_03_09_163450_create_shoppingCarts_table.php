<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoppingCarts', function (Blueprint $table) {
            $table->timestamps();
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->float('shipping_price', 8, 4);
            $table->float('subtotal', 8, 2);
            $table->float('total', 8, 2);
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_carts');
    }
}
