<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwimmingMomentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swimming_moments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('classroom_id');
            $table->foreignId('invoice_id');
            $table->dateTime('date');
            $table->integer('amount');

            // Foreign key relation
            $table->foreign('classroom_id')->references('id')->on('classrooms');
            $table->foreign('invoice_id')->references('id')->on('invoices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('swimming_moments');
    }
}
