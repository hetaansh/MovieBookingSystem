<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('screen_id');
            $table->foreign('screen_id')
              ->references('id')->on('screens');
            $table->unsignedInteger('movie_id');
            $table->foreign('movie_id')
              ->references('id')->on('movies');
            $table->time('time');
            $table->dateTime('date');
            $table->time('start');
            $table->time('end');
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
        Schema::dropIfExists('shows');
    }
};
