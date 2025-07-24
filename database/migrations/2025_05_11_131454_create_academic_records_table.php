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
        Schema::create('academic_records', function (Blueprint $table) {
            $table->id();
            $table->string('qualification_code'); // Qualification Code
            $table->string('qualification_name'); // Qualification Name
            $table->string('qualification_cadre'); // Qualification Cadre
            $table->date('graduation_date'); // Graduation Date
            $table->string('institution_name'); // Institution Name
            $table->string('file_path'); // Path to the attached PDF document
            $table->unsignedBigInteger('user_id'); // User ID of the person who created
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_records');
    }
};
