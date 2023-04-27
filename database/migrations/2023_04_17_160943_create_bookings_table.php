<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('amount');
            $table->unsignedInteger('cinema_id');
            $table->foreign('cinema_id')
                ->references('id')->on('cinemas');
            $table->unsignedInteger('movie_id');
            $table->foreign('movie_id')
                ->references('id')->on('movies');
            $table->unsignedInteger('screen_id');
            $table->foreign('screen_id')
                ->references('id')->on('screens');
            $table->unsignedInteger('show_id');
            $table->foreign('show_id')
                ->references('id')->on('shows')->onDelete('cascade');
            $table->string('seat_array');
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
        Schema::dropIfExists('bookings');
    }
};
