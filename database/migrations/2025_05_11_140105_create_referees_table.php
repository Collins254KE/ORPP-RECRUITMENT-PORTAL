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
        Schema::create('referees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // First Name
            $table->string('middle_name')->nullable(); // Middle Name
            $table->string('other_name')->nullable(); // Other Name
            $table->string('organization'); // Organization
            $table->string('designation'); // Designation
            $table->string('postal_address'); // Postal Address
            $table->string('postal_code'); // Postal Code
            $table->string('city_town'); // City/Town
            $table->string('referee_type'); // Type of Referee (Professional or Personal)
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
        Schema::dropIfExists('referees');
    }
};
