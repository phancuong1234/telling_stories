<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoriesAgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories_age', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('age_id')->unsigned();
            $table->foreign('age_id')->references('id')->on('ages');
            $table->bigInteger('story_id')->unsigned();
            $table->foreign('story_id')->references('id')->on('stories');
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
        Schema::dropIfExists('stories_age');
    }
}
