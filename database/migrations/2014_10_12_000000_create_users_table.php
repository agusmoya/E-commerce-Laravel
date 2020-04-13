<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->timestamps();
      $table->bigIncrements('id');
      $table->string('name')->string();
      $table->string('surname')->string();
      $table->string('province')->nullable();
      $table->string('email')->unique();
      $table->boolean('type')->nullable();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->string('profilePhoto', 200);
      $table->rememberToken();
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
    Schema::dropIfExists('users');
  }
}
