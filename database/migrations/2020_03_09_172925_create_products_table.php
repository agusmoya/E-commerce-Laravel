<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('trademark_id')->unsigned();
            $table->string('name', 100);
            $table->string('description', 180)->nullable();
            $table->integer('stock')->nullable();
            $table->string('available', 10)->nullable();
            $table->float('price', 8, 2);
            $table->string('photo', 200);
            $table->foreign('category_id')
            ->references('id')->on('categories')
            ->onDelete('cascade');
            $table->foreign('trademark_id')
            ->references('id')->on('trademarks')
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
        Schema::dropIfExists('products');
    }
}
