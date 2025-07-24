<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBiodataFieldsToUsersTable extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'title')) {
                $table->string('title')->nullable();
            }
            if (!Schema::hasColumn('users', 'id_passport')) {
                $table->string('id_passport')->nullable();
            }
            if (!Schema::hasColumn('users', 'kra_pin')) {
                $table->string('kra_pin')->nullable();
            }
            if (!Schema::hasColumn('users', 'county')) {
                $table->string('county')->nullable();
            }
            if (!Schema::hasColumn('users', 'sub_county')) {
                $table->string('sub_county')->nullable();
            }
             if (!Schema::hasColumn('users', 'ward')) {
                $table->string('ward')->nullable();
            }
            if (!Schema::hasColumn('users', 'ethnicity')) {
                $table->string('ethnicity')->nullable();
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender')->nullable();
            }
            if (!Schema::hasColumn('users', 'nationality')) {
                $table->string('nationality')->nullable();
            }
            if (!Schema::hasColumn('users', 'dob')) {
                $table->date('dob')->nullable();
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('users', 'disability_status')) {
                $table->enum('disability_status', ['yes', 'no'])->default('no');
            }
            if (!Schema::hasColumn('users', 'disability_certificate_number')) {
                $table->string('disability_certificate_number')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'title')) {
                $table->dropColumn('title');
            }
            if (Schema::hasColumn('users', 'id_passport')) {
                $table->dropColumn('id_passport');
            }
            if (Schema::hasColumn('users', 'kra_pin')) {
                $table->dropColumn('kra_pin');
            }
            if (Schema::hasColumn('users', 'county')) {
                $table->dropColumn('county');
            }
            if (Schema::hasColumn('users', 'sub_county')) {
                $table->dropColumn('sub_county');
            }
             if (Schema::hasColumn('users', 'ward')) {
                $table->dropColumn('ward');
            }
            if (Schema::hasColumn('users', 'ethnicity')) {
                $table->dropColumn('ethnicity');
            }
            if (Schema::hasColumn('users', 'gender')) {
                $table->dropColumn('gender');
            }
            if (Schema::hasColumn('users', 'nationality')) {
                $table->dropColumn('nationality');
            }
            if (Schema::hasColumn('users', 'dob')) {
                $table->dropColumn('dob');
            }
            if (Schema::hasColumn('users', 'phone')) {
                $table->dropColumn('phone');
            }
            if (Schema::hasColumn('users', 'disability_status')) {
                $table->dropColumn('disability_status');
            }
            if (Schema::hasColumn('users', 'disability_certificate_number')) {
                $table->dropColumn('disability_certificate_number');
            }
        });
    }
}
