<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE users ALTER COLUMN title DROP NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN id_passport DROP NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN kra_pin DROP NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN county DROP NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN sub_county DROP NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN ethnicity DROP NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN nationality DROP NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN gender DROP NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN dob DROP NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN disability_status DROP NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN disability_certificate_number DROP NOT NULL');
    }

    public function down()
    {
        DB::statement('ALTER TABLE users ALTER COLUMN title SET NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN id_passport SET NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN kra_pin SET NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN county SET NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN sub_county SET NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN ethnicity SET NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN nationality SET NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN gender SET NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN dob SET NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN disability_status SET NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN disability_certificate_number SET NOT NULL');
    }
};
