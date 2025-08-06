<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clean users table in local environment only
        if (app()->environment('local')) {
            if (DB::getDriverName() === 'mysql') {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                DB::table('users')->truncate();
                DB::table('job_listings')->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            } else {
                // For PostgreSQL, use cascade to truncate
                DB::statement('TRUNCATE TABLE users CASCADE;');
                DB::statement('TRUNCATE TABLE job_listings CASCADE;');
            }
        }

        // Create default ORPP Admin User
        $admin = User::firstOrCreate(
            ['email' => 'collinskiprotich2018@gmail.com'],
            [
                'name' => 'ORPP RECRUITMENT',
                'title' => 'Mr',
                'phone' => '0712345678',
                'id_passport' => '12345678',
                'kra_pin' => 'A000000000B',
                'is_staff' => true,
                'role' => 'admin',
                'county' => 'Nairobi',
                'sub_county' => 'Westlands',
                'ethnicity' => 'Kalenjin',
                'gender' => 'Male',
                'nationality' => 'Kenyan',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),

                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // event(new Registered($admin));

        // Create sample applicant users
        User::firstOrCreate(
            ['email' => 'john.doe@example.com'],
            [
                'name' => 'John Doe',
                'title' => 'Mr',
                'phone' => '1234567890',
                'id_passport' => 'A12345678',
                'kra_pin' => 'KRA123456',
                'is_staff' => false,
                'role' => 'applicant',
                'county' => 'Nairobi',
                'sub_county' => 'Langata',
                'ethnicity' => 'Luo',
                'gender' => 'Male',
                'nationality' => 'Kenyan',
                'date_of_birth' => '1990-05-12',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'jane.smith@example.com'],
            [
                'name' => 'Jane Smith',
                'title' => 'Mrs',
                'phone' => '0987654321',
                'id_passport' => 'B87654321',
                'kra_pin' => 'KRA654321',
                'is_staff' => false,
                'role' => 'applicant',
                'county' => 'Kiambu',
                'sub_county' => 'Ruiru',
                'ethnicity' => 'Kikuyu',
                'gender' => 'Female',
                'nationality' => 'Kenyan',
                'date_of_birth' => '1992-08-20',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Seed job listings and applicants
        $this->call([
            JobListingsTableSeeder::class,
            ApplicantsSeeder::class,
        ]);
    }
}
