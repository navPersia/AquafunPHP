<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number')->nullable();
            $table->string('street')->nullable();
            $table->integer('house_number')->nullable();
            $table->string('mailbox_number')->nullable();
            $table->integer('postal_code')->nullable();
            $table->string('place')->nullable();
            $table->string('email')->unique();
            $table->date('birth_date')->nullable();
            $table->string('remark')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('admin')->default(false);
            $table->boolean('teacher')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        //  Gebruikers toevoegen
        DB::table('users')->insert(
            [
                [
                    'name' => 'John Doe',
                    "phone_number" => "0477777777",
                    'street' => 'Leempustraat',
                    'house_number' => '31',
                    'postal_code' => '2600',
                    'place' => 'Antwerpen',
                    'email' => 'john.doe@example.com',
                    'birth_date' => '1990-01-01',
                    'admin' => true,
                    'teacher' => false,
                    'password' => Hash::make('admin1234'),
                    'created_at' => now(),
                    'email_verified_at' => now(),
                ],
                [
                    'name' => 'Jane Doe',
                    "phone_number" => "0488888888",
                    "street" => "Berchemlei",
                    'house_number' => '13',
                    'postal_code' => '2140',
                    'place' => 'Antwerpen',
                    'email' => 'jane.doe@example.com',
                    'birth_date' => '1990-12-01',
                    'admin' => false,
                    'teacher' => true,
                    'password' => Hash::make('user1234'),
                    'created_at' => now(),
                    'email_verified_at' => now(),
                ],
                [
                    'name' => 'Jordy Doe',
                    "phone_number" => "0499999999",
                    'street' => 'Leempulei',
                    'house_number' => '113',
                    'postal_code' => '2060',
                    'place' => 'Antwerpen',
                    'email' => 'jordy.doe@example.com',
                    'birth_date' => '1990-10-10',
                    'admin' => false,
                    'teacher' => false,
                    'password' => Hash::make('user5678'),
                    'created_at' => now(),
                    'email_verified_at' => now(),
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
        Schema::dropIfExists('users');
    }
}
