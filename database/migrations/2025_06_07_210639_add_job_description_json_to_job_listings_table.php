<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('job_listings', 'description')) {
            Schema::table('job_listings', function (Blueprint $table) {
                $table->longText('description');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('job_listings', 'description')) {
            Schema::table('job_listings', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }
    }
};
