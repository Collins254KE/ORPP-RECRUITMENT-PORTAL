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
        Schema::create('professional_memberships', function (Blueprint $table) {
            $table->id();
            $table->string('description'); // Description of the membership
            $table->string('file_path'); // Path to the attached PDF document
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
        Schema::dropIfExists('professional_memberships');
    }
};
