<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'disability_status')) {
                $table->string('disability_status')->nullable();
            }

            if (!Schema::hasColumn('users', 'disability_certificate_number')) {
                $table->string('disability_certificate_number')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'disability_status')) {
                $table->dropColumn('disability_status');
            }

            if (Schema::hasColumn('users', 'disability_certificate_number')) {
                $table->dropColumn('disability_certificate_number');
            }
        });
    }
};
