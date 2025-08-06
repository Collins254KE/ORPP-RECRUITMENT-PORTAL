<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\AcademicRecord;
use App\Models\ProfessionalQualification;
use App\Models\ProfessionalMembership;
use App\Models\EmploymentHistory;
use App\Models\Referee;

class ApplicantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $applicants = [
            // [
            //     'name' => 'Sarah Wanjiku Kamau',
            //     'title' => 'Ms',
            //     'phone' => '0712345671',
            //     'id_passport' => 'A12345671',
            //     'kra_pin' => 'A000000001B',
            //     'email' => 'sarah.kamau@example.com',
            //     'county' => 'Nairobi',
            //     'sub_county' => 'Westlands',
            //     'ward' => 'Parklands',
            //     'ethnicity' => 'Kikuyu',
            //     'nationality' => 'Kenyan',
            //     'gender' => 'Female',
            //     'dob' => '1990-03-15',
            //     'disability_status' => 'no',
            //     'is_staff' => false,
            //     'role' => 'applicant',
            //     'password' => Hash::make('password123'),
            //     'email_verified_at' => now(),
            // ],
            
            [
                'name' => 'James Odhiambo Ochieng',
                'title' => 'Mr',
                'phone' => '0723456782',
                'id_passport' => 'B23456789',
                'kra_pin' => 'A000000002B',
                'email' => 'james.ochieng@example.com',
                'county' => 'Kisumu',
                'sub_county' => 'Kisumu Central',
                'ward' => 'Kisumu Central',
                'ethnicity' => 'Luo',
                'nationality' => 'Kenyan',
                'gender' => 'Male',
                'dob' => '1988-07-22',
                'disability_status' => 'no',
                'is_staff' => false,
                'role' => 'applicant',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Fatima Hassan Ali',
                'title' => 'Ms',
                'phone' => '0734567893',
                'id_passport' => 'C34567890',
                'kra_pin' => 'A000000003B',
                'email' => 'fatima.ali@example.com',
                'county' => 'Mombasa',
                'sub_county' => 'Mombasa Island',
                'ward' => 'Old Town',
                'ethnicity' => 'Somali',
                'nationality' => 'Kenyan',
                'gender' => 'Female',
                'dob' => '1992-11-08',
                'disability_status' => 'no',
                'is_staff' => false,
                'role' => 'applicant',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'David Kiprop Rono',
                'title' => 'Mr',
                'phone' => '0745678904',
                'id_passport' => 'D45678901',
                'kra_pin' => 'A000000004B',
                'email' => 'david.rono@example.com',
                'county' => 'Nakuru',
                'sub_county' => 'Nakuru Town East',
                'ward' => 'Biashara',
                'ethnicity' => 'Kalenjin',
                'nationality' => 'Kenyan',
                'gender' => 'Male',
                'dob' => '1985-12-03',
                'disability_status' => 'no',
                'is_staff' => false,
                'role' => 'applicant',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Grace Akinyi Otieno',
                'title' => 'Mrs',
                'phone' => '0756789015',
                'id_passport' => 'E56789012',
                'kra_pin' => 'A000000005B',
                'email' => 'grace.otieno@example.com',
                'county' => 'Kiambu',
                'sub_county' => 'Ruiru',
                'ward' => 'Ruiru',
                'ethnicity' => 'Luo',
                'nationality' => 'Kenyan',
                'gender' => 'Female',
                'dob' => '1987-04-18',
                'disability_status' => 'no',
                'is_staff' => false,
                'role' => 'applicant',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Peter Mwangi Njoroge',
                'title' => 'Mr',
                'phone' => '0767890126',
                'id_passport' => 'F67890123',
                'kra_pin' => 'A000000006B',
                'email' => 'peter.njoroge@example.com',
                'county' => 'Nairobi',
                'sub_county' => 'Langata',
                'ward' => 'Karen',
                'ethnicity' => 'Kikuyu',
                'nationality' => 'Kenyan',
                'gender' => 'Male',
                'dob' => '1991-09-25',
                'disability_status' => 'no',
                'is_staff' => false,
                'role' => 'applicant',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Mary Wambui Muthoni',
                'title' => 'Ms',
                'phone' => '0778901237',
                'id_passport' => 'G78901234',
                'kra_pin' => 'A000000007B',
                'email' => 'mary.muthoni@example.com',
                'county' => 'Nyeri',
                'sub_county' => 'Nyeri Central',
                'ward' => 'Nyeri Central',
                'ethnicity' => 'Kikuyu',
                'nationality' => 'Kenyan',
                'gender' => 'Female',
                'dob' => '1989-06-12',
                'disability_status' => 'no',
                'is_staff' => false,
                'role' => 'applicant',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'John Kipchoge Cheruiyot',
                'title' => 'Mr',
                'phone' => '0789012345',
                'id_passport' => 'H89012345',
                'kra_pin' => 'A000000008B',
                'email' => 'john.cheruiyot@example.com',
                'county' => 'Eldoret',
                'sub_county' => 'Eldoret East',
                'ward' => 'Eldoret East',
                'ethnicity' => 'Kalenjin',
                'nationality' => 'Kenyan',
                'gender' => 'Male',
                'dob' => '1986-02-28',
                'disability_status' => 'no',
                'is_staff' => false,
                'role' => 'applicant',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Amina Salim Omar',
                'title' => 'Ms',
                'phone' => '0790123456',
                'id_passport' => 'I90123456',
                'kra_pin' => 'A000000009B',
                'email' => 'amina.omar@example.com',
                'county' => 'Mombasa',
                'sub_county' => 'Nyali',
                'ward' => 'Nyali',
                'ethnicity' => 'Somali',
                'nationality' => 'Kenyan',
                'gender' => 'Female',
                'dob' => '1993-08-14',
                'disability_status' => 'no',
                'is_staff' => false,
                'role' => 'applicant',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Michael Ochieng Owino',
                'title' => 'Mr',
                'phone' => '0701234567',
                'id_passport' => 'J01234567',
                'kra_pin' => 'A000000010B',
                'email' => 'michael.owino@example.com',
                'county' => 'Kisumu',
                'sub_county' => 'Kisumu West',
                'ward' => 'Kisumu West',
                'ethnicity' => 'Luo',
                'nationality' => 'Kenyan',
                'gender' => 'Male',
                'dob' => '1990-01-30',
                'disability_status' => 'no',
                'is_staff' => false,
                'role' => 'applicant',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ],
        ];
        foreach ($applicants as $applicantData) {
            $user = User::create($applicantData);

            // Create Academic Records
            $this->createAcademicRecords($user);

            // Create Professional Qualifications
            $this->createProfessionalQualifications($user);

            // Create Professional Memberships
            $this->createProfessionalMemberships($user);

            // Create Employment History
            $this->createEmploymentHistory($user);

            // Create Referees
            $this->createReferees($user);
        }
    }

    private function createAcademicRecords($user)
    {
        $academicRecords = [
            [
                'qualification_code' => '3',
                'qualification_name' => 'Bachelor of Commerce',
                'qualification_cadre' => 'Business',
                'graduation_date' => '2015-06-15',
                'institution_name' => 'University of Nairobi',
                'file_path' => 'user.academic_records/sample_degree.pdf',
            ],
            [
                'qualification_code' => '2',
                'qualification_name' => 'Diploma in Business Management',
                'qualification_cadre' => 'Business',
                'graduation_date' => '2012-12-10',
                'institution_name' => 'Kenya Institute of Management',
                'file_path' => 'user.academic_records/sample_diploma.pdf',
            ],
        ];

        foreach ($academicRecords as $record) {
            AcademicRecord::create(array_merge($record, ['user_id' => $user->id]));
        }
    }

    private function createProfessionalQualifications($user)
    {
        $qualifications = [
            [
                'level' => '3',
                'description' => 'Certified Public Accountant (CPA)',
                'file_path' => 'user.professional_qualifications/sample_cpa.pdf',
            ],
            [
                'level' => '2',
                'description' => 'Human Resource Management Certificate',
                'file_path' => 'user.professional_qualifications/sample_hr.pdf',
            ],
        ];

        foreach ($qualifications as $qualification) {
            ProfessionalQualification::create(array_merge($qualification, ['user_id' => $user->id]));
        }
    }

    private function createProfessionalMemberships($user)
    {
        $memberships = [
            [
                'description' => 'Member of Institute of Certified Public Accountants of Kenya (ICPAK)',
                'file_path' => 'user.professional_memberships/sample_icpak.pdf',
            ],
            [
                'description' => 'Member of Kenya Institute of Management (KIM)',
                'file_path' => 'user.professional_memberships/sample_kim.pdf',
            ],
        ];

        foreach ($memberships as $membership) {
            ProfessionalMembership::create(array_merge($membership, ['user_id' => $user->id]));
        }
    }

    private function createEmploymentHistory($user)
    {
        $employmentHistory = [
            [
                'employer_name' => 'ABC Company Limited',
                'job_position' => 'Accountant',
                'date_joined' => '2016-01-15',
                'date_left' => '2020-03-31',
                'roles_responsibilities' => '• Prepared financial statements and reports
• Processed accounts payable and receivable
• Maintained general ledger
• Conducted monthly reconciliations
• Assisted in budget preparation',
            ],
            [
                'employer_name' => 'XYZ Corporation',
                'job_position' => 'Senior Accountant',
                'date_joined' => '2020-04-01',
                'date_left' => null, // Current position
                'roles_responsibilities' => '• Lead financial reporting and analysis
• Supervise junior accounting staff
• Coordinate with external auditors
• Develop and implement accounting policies
• Manage tax compliance and reporting',
            ],
        ];

        foreach ($employmentHistory as $employment) {
            EmploymentHistory::create(array_merge($employment, ['user_id' => $user->id]));
        }
    }

    private function createReferees($user)
    {
        $referees = [
            [
                'first_name' => 'Dr. Jane',
                'middle_name' => 'Wanjiku',
                'other_name' => 'Kamau',
                'organization' => 'University of Nairobi',
                'designation' => 'Senior Lecturer',
                'postal_address' => 'P.O. Box 30197',
                'postal_code' => '00100',
                'city_town' => 'Nairobi',
                'referee_type' => 'academic',
                'email' => 'jane.kamau@uonbi.ac.ke',
                'mobile_phone' => '0712345678',
            ],
            [
                'first_name' => 'Mr. John',
                'middle_name' => 'Kiprop',
                'other_name' => 'Rono',
                'organization' => 'ABC Company Limited',
                'designation' => 'Finance Manager',
                'postal_address' => 'P.O. Box 12345',
                'postal_code' => '00100',
                'city_town' => 'Nairobi',
                'referee_type' => 'professional',
                'email' => 'john.rono@abc.com',
                'mobile_phone' => '0723456789',
            ],
        ];

        foreach ($referees as $referee) {
            Referee::create(array_merge($referee, ['user_id' => $user->id]));
        }
    }
} 