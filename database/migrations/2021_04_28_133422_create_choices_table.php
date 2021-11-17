<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('swimming_lesson_id');
            $table->timestamps();

            // Foreign key relation
            $table->foreign("user_id")->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign("swimming_lesson_id")->references('id')->on('swimming_lessons')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('choices');
    }
}
