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
        Schema::table('users', function (Blueprint $table) {
       // $table->date('dob')->nullable();
       // $table->string('county')->nullable();
       // $table->string('sub_county')->nullable();
        //$table->string('ethnicity')->nullable();
        //$table->string('gender')->nullable();
      //  $table->string('nationality')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn(['dob', 'sub_county', 'ethnicity', 'gender', 'nationality']);

        });
    }
};
