<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_listing_id'); // Job listing ID
            $table->unsignedBigInteger('user_id'); // User ID of the applicant
            $table->enum('status', ['Processing', 'Interviews', 'Shortlisted', 'Closed'])->default('Processing'); // Application status
            $table->unsignedBigInteger('updated_by')->nullable(); // User ID of the person who updated the application
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraints
            $table->foreign('job_listing_id')->references('id')->on('job_listings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['job_listing_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['updated_by']);
        });
        Schema::dropIfExists('applications');
    }
};
