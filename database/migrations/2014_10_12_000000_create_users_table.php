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
        Schema::create('users', function (Blueprint $table) {
                       $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('phone')->unique();
            $table->string('id_passport')->unique();
            $table->string('kra_pin')->unique();
            $table->string('gender')->nullable();
            $table->string('county')->nullable();
            $table->string('sub_county')->nullable();
            $table->string('ethnicity')->nullable(); // fixed spelling here
            $table->string('nationality')->nullable();
            $table->date('date_of_birth')->nullable(); // better as date type
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
