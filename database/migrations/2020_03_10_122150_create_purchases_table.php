<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('shoppingCart_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('payment_method', 50);
            $table->foreign('user_id')
            ->references('id')->on('users');
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
        Schema::dropIfExists('purchases');
    }
}
