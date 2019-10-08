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
            $table->string('point')->default(0);
            $table->bigInteger('views')->default(0);
            $table->bigInteger('user_id');
            $table->bigInteger('story_id');
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
