<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'title')) {
                $table->string('title')->nullable();
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('users', 'id_passport')) {
                $table->string('id_passport')->nullable();
            }
            if (!Schema::hasColumn('users', 'kra_pin')) {
                $table->string('kra_pin')->nullable();
            }
            if (!Schema::hasColumn('users', 'is_staff')) {
                $table->boolean('is_staff')->default(false);
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('applicant');
            }
            if (!Schema::hasColumn('users', 'county')) {
                $table->string('county')->nullable();
            }
            if (!Schema::hasColumn('users', 'sub_county')) {
                $table->string('sub_county')->nullable();
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
            if (!Schema::hasColumn('users', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'phone',
                'id_passport',
                'kra_pin',
                'is_staff',
                'role',
                'county',
                'sub_county',
                'ethnicity',
                'gender',
                'nationality',
                'date_of_birth',
            ]);
        });
    }
};
