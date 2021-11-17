<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->double('price')->nullable();
            $table->boolean('status');
        });

        DB::table('meals')->insert(
            [
                [
                    'name' => 'Geen',
                    'price' => 0,
                    'status' => True
                ],
                [
                    'name' => 'Spaghetti bolognaise',
                    'price' => 9.99,
                    'status' => True
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals');
    }
}
