<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('street');
            $table->string('house_number');
            $table->string('mailbox_number')->nullable();
            $table->string('postal_code');
            $table->string('place');
        });

        DB::table('schools')->insert(
            [
               'name' => 'Wilfam',
                'email' => 'info@wilfam.be',
                'phone_number' => ' 032391788',
                'street' => 'Jan Moorkensstraat',
                'house_number' => '95',
                'postal_code' => '2600',
                'place' => 'Berchem'
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
        Schema::dropIfExists('schools');
    }
}
