<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwimmingLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swimming_lessons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime("start_time");
            $table->dateTime("end_time");
            $table->foreignId('user_id');
            $table->foreignId("rate_id");
            $table->string("weekday");
            $table->boolean("status");

            // Foreign key relation
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign("rate_id")->references('id')->on('rates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('swimming_lessons');
    }
}
