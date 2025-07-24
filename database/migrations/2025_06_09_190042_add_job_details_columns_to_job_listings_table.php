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
        Schema::table('job_listings', function (Blueprint $table) {
            if (!Schema::hasColumn('job_listings', 'duties_and_responsibilities')) {
                $table->text('duties_and_responsibilities')->nullable();
            }
            if (!Schema::hasColumn('job_listings', 'requirements')) {
                $table->text('requirements')->nullable();
            }
            if (!Schema::hasColumn('job_listings', 'benefits')) {
                $table->text('benefits')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->dropColumn([
                'duties_and_responsibilities',
                'requirements',
                'benefits',
            ]);
        });
    }
};
