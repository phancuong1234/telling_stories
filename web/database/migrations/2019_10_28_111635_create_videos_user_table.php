<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('path');
            $table->bigInteger('point')->default(0);
            $table->bigInteger('views')->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('story_id')->unsigned();
            $table->foreign('story_id')->references('id')->on('stories');
            $table->tinyInteger('display_flg')->default(1);
            $table->tinyInteger('delete_flg')->default(0);
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
        Schema::dropIfExists('videos_user');
    }
}
