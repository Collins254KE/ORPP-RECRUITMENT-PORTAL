<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Make columns nullable using raw SQL (doesn't require Doctrine DBAL)
        DB::statement('ALTER TABLE users MODIFY title VARCHAR(255) NULL');
        DB::statement('ALTER TABLE users MODIFY id_passport VARCHAR(255) NULL');
        DB::statement('ALTER TABLE users MODIFY kra_pin VARCHAR(255) NULL');
        DB::statement('ALTER TABLE users MODIFY county VARCHAR(255) NULL');
        DB::statement('ALTER TABLE users MODIFY sub_county VARCHAR(255) NULL');
        DB::statement('ALTER TABLE users MODIFY ethnicity VARCHAR(255) NULL');
        DB::statement('ALTER TABLE users MODIFY nationality VARCHAR(255) NULL');
        DB::statement('ALTER TABLE users MODIFY gender VARCHAR(255) NULL');
        DB::statement('ALTER TABLE users MODIFY dob DATE NULL');
        DB::statement('ALTER TABLE users MODIFY disability_status VARCHAR(255) NULL');
        DB::statement('ALTER TABLE users MODIFY disability_certificate_number VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Make columns NOT NULL again
        DB::statement('ALTER TABLE users MODIFY title VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE users MODIFY id_passport VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE users MODIFY kra_pin VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE users MODIFY county VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE users MODIFY sub_county VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE users MODIFY ethnicity VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE users MODIFY nationality VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE users MODIFY gender VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE users MODIFY dob DATE NOT NULL');
        DB::statement('ALTER TABLE users MODIFY disability_status VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE users MODIFY disability_certificate_number VARCHAR(255) NOT NULL');
    }
};
