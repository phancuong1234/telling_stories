<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('password')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->tinyInteger('state')->default(0);
            $table->string('avatar')->nullable();
            $table->integer('role_id')->default(3)->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('remember_token')->nullable();
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
