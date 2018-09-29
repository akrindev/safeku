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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
          	$table->bigInteger('provider_id');
          	$table->string('username');
          	$table->enum('gender',['cowok','cewek','hode'])->default('hode');
          	$table->text('tentang');
          	$table->string('alamat');
          	$table->text('link');
          	$table->boolean('banned')->default(0);
          	$table->enum('role',['admin','staff','member'])->default('member');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}