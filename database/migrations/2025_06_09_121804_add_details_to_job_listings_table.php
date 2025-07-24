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
            $table->text('duties_and_responsibilities')->nullable();
            $table->text('requirements')->nullable();
            $table->text('benefits')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Check and drop each column safely
        if (Schema::hasColumn('job_listings', 'duties_and_responsibilities') ||
            Schema::hasColumn('job_listings', 'requirements') ||
            Schema::hasColumn('job_listings', 'benefits')) {

            Schema::table('job_listings', function (Blueprint $table) {
                if (Schema::hasColumn('job_listings', 'duties_and_responsibilities')) {
                    $table->dropColumn('duties_and_responsibilities');
                }
                if (Schema::hasColumn('job_listings', 'requirements')) {
                    $table->dropColumn('requirements');
                }
                if (Schema::hasColumn('job_listings', 'benefits')) {
                    $table->dropColumn('benefits');
                }
            });
        }
    }
};
