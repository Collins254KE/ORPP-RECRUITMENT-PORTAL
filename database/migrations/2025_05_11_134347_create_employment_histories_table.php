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
        Schema::create('employment_histories', function (Blueprint $table) {
            $table->id();
            $table->string('employer_name'); // Employer Name
            $table->string('job_position'); // Job Position held
            $table->date('date_joined'); // Date of Joining
            $table->date('date_left')->nullable(); // Date Left (nullable)
            $table->text('roles_responsibilities'); // Summary of Roles & Responsibilities
            $table->unsignedBigInteger('user_id'); // User ID of the person who created the record
            $table->timestamps();

            // Foreign key constraint
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
        Schema::dropIfExists('employment_histories');
    }
};
