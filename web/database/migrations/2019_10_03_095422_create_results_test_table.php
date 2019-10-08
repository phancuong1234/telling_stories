<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results_test', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('count_answer_true');
            $table->bigInteger('point');
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
        Schema::dropIfExists('results_test');
    }
}
