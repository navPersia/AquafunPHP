<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwimmingPartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swimming_parties', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date');
            $table->foreignId('user_id');
            $table->time("start_time");
            $table->time("end_time");
            $table->string('name');
            $table->string('email');
            $table->boolean('status');
            $table->integer('amount');
            $table->foreignId('rate_id');
            $table->foreignId('meal_id')->nullable();

            // Foreign key relation
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('rate_id')->references('id')->on('rates');
            $table->foreign('meal_id')->references('id')->on('meals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('swimming_parties');
    }
}
