<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JobListingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobListings = [
            [
                'title' => 'Records Management Officer',
                'code' => 'RMO-2024-001',
                'location' => 'Nairobi, Kenya',
                'posts' => 2,
                'deadline' => Carbon::now()->addDays(30),
                'duties_and_responsibilities' => '• Maintain and organize official records and documents
• Implement records management policies and procedures
• Ensure proper filing and retrieval systems
• Coordinate with various departments for document management
• Conduct regular audits of records and archives
• Train staff on records management best practices
• Ensure compliance with data protection regulations',
                'requirements' => '• Bachelor\'s degree in Information Science, Library Science, or related field
• Minimum 3 years experience in records management
• Knowledge of electronic document management systems
• Strong organizational and analytical skills
• Proficiency in Microsoft Office Suite
• Excellent communication and interpersonal skills',
                'is_published' => 1,
                'created_by' => 1,
                'min_years_of_experience' => 3,
                'min_level' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Human Resource Officer',
                'code' => 'HRO-2024-002',
                'location' => 'Mombasa, Kenya',
                'posts' => 1,
                'deadline' => Carbon::now()->addDays(45),
                'duties_and_responsibilities' => '• Assist in recruitment and selection processes
• Maintain employee records and HR databases
• Process payroll and benefits administration
• Handle employee relations and grievances
• Coordinate training and development programs
• Ensure compliance with labor laws and regulations
• Prepare HR reports and documentation',
                'requirements' => '• Bachelor\'s degree in Human Resource Management or Business Administration
• Minimum 2 years experience in HR functions
• Knowledge of Kenyan labor laws
• Strong interpersonal and communication skills
• Proficiency in HRIS and Microsoft Office
• Professional certification in HR is an added advantage',
                'is_published' => 1,
                'created_by' => 1,
                'min_years_of_experience' => 2,
                'min_level' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Finance Officer',
                'code' => 'FO-2024-003',
                'location' => 'Kisumu, Kenya',
                'posts' => 1,
                'deadline' => Carbon::now()->addDays(40),
                'duties_and_responsibilities' => '• Prepare financial statements and reports
• Process accounts payable and receivable
• Maintain general ledger and financial records
• Assist in budget preparation and monitoring
• Conduct financial analysis and forecasting
• Ensure compliance with accounting standards
• Coordinate with external auditors',
                'requirements' => '• Bachelor\'s degree in Accounting, Finance, or related field
• Minimum 3 years experience in accounting/finance
• Professional qualification (CPA, ACCA) is preferred
• Knowledge of accounting software (QuickBooks, Sage)
• Strong analytical and problem-solving skills
• Attention to detail and accuracy',
                'is_published' => 1,
                'created_by' => 1,
                'min_years_of_experience' => 3,
                'min_level' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'IT Support Specialist',
                'code' => 'ITS-2024-004',
                'location' => 'Nakuru, Kenya',
                'posts' => 2,
                'deadline' => Carbon::now()->addDays(35),
                'duties_and_responsibilities' => '• Provide technical support to end users
• Install, configure, and maintain computer systems
• Troubleshoot hardware and software issues
• Manage network infrastructure and security
• Conduct system backups and recovery
• Train users on new technologies
• Maintain IT inventory and documentation',
                'requirements' => '• Diploma or Degree in Information Technology, Computer Science, or related field
• Minimum 2 years experience in IT support
• Knowledge of Windows and Linux operating systems
• Experience with networking and security protocols
• Strong troubleshooting and problem-solving skills
• Excellent customer service skills',
                'is_published' => 1,
                'created_by' => 1,
                'min_years_of_experience' => 2,
                'min_level' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Administrative Assistant',
                'code' => 'AA-2024-005',
                'location' => 'Eldoret, Kenya',
                'posts' => 3,
                'deadline' => Carbon::now()->addDays(25),
                'duties_and_responsibilities' => '• Provide administrative support to management
• Schedule meetings and manage calendars
• Prepare and distribute correspondence
• Maintain filing systems and databases
• Coordinate travel arrangements
• Handle office supplies and equipment
• Assist in event planning and coordination',
                'requirements' => '• Diploma in Business Administration, Secretarial Studies, or related field
• Minimum 1 year experience in administrative role
• Proficiency in Microsoft Office Suite
• Excellent organizational and time management skills
• Strong written and verbal communication skills
• Ability to work independently and as part of a team',
                'is_published' => 1,
                'created_by' => 1,
                'min_years_of_experience' => 1,
                'min_level' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Legal Officer',
                'code' => 'LO-2024-006',
                'location' => 'Nairobi, Kenya',
                'posts' => 1,
                'deadline' => Carbon::now()->addDays(50),
                'duties_and_responsibilities' => '• Provide legal advice and support to the organization
• Review and draft legal documents and contracts
• Ensure compliance with applicable laws and regulations
• Represent the organization in legal matters
• Conduct legal research and analysis
• Liaise with external legal counsel when necessary
• Maintain legal documentation and records',
                'requirements' => '• Bachelor of Laws (LLB) degree from a recognized university
• Minimum 3 years post-admission experience
• Valid practicing certificate
• Knowledge of corporate and commercial law
• Strong analytical and research skills
• Excellent written and verbal communication skills',
                'is_published' => 1,
                'created_by' => 1,
                'min_years_of_experience' => 3,
                'min_level' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Communications Officer',
                'code' => 'CO-2024-007',
                'location' => 'Mombasa, Kenya',
                'posts' => 1,
                'deadline' => Carbon::now()->addDays(30),
                'duties_and_responsibilities' => '• Develop and implement communication strategies
• Create content for various communication channels
• Manage social media platforms and website content
• Coordinate public relations activities
• Prepare press releases and media materials
• Organize events and public engagements
• Monitor media coverage and public perception',
                'requirements' => '• Bachelor\'s degree in Communications, Journalism, or related field
• Minimum 2 years experience in communications or PR
• Strong writing and editing skills
• Knowledge of digital marketing and social media
• Experience with content management systems
• Creative thinking and problem-solving abilities',
                'is_published' => 1,
                'created_by' => 1,
                'min_years_of_experience' => 2,
                'min_level' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Procurement Officer',
                'code' => 'PO-2024-008',
                'location' => 'Kisumu, Kenya',
                'posts' => 1,
                'deadline' => Carbon::now()->addDays(40),
                'duties_and_responsibilities' => '• Manage procurement processes and procedures
• Source and evaluate suppliers and vendors
• Prepare and review purchase orders and contracts
• Negotiate prices and terms with suppliers
• Ensure compliance with procurement policies
• Maintain supplier relationships and performance
• Conduct market research and analysis',
                'requirements' => '• Bachelor\'s degree in Supply Chain Management, Business Administration, or related field
• Minimum 3 years experience in procurement
• Knowledge of procurement laws and regulations
• Strong negotiation and analytical skills
• Proficiency in procurement software
• Excellent organizational and communication skills',
                'is_published' => 1,
                'created_by' => 1,
                'min_years_of_experience' => 3,
                'min_level' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Research Assistant',
                'code' => 'RA-2024-009',
                'location' => 'Nakuru, Kenya',
                'posts' => 2,
                'deadline' => Carbon::now()->addDays(35),
                'duties_and_responsibilities' => '• Assist in research project planning and execution
• Collect and analyze data from various sources
• Prepare research reports and presentations
• Conduct literature reviews and background research
• Maintain research databases and documentation
• Coordinate with research partners and stakeholders
• Assist in grant proposal writing',
                'requirements' => '• Bachelor\'s degree in relevant field (Social Sciences, Sciences, etc.)
• Minimum 1 year experience in research
• Strong analytical and research skills
• Proficiency in statistical analysis software
• Excellent written and verbal communication skills
• Ability to work independently and meet deadlines',
                'is_published' => 1,
                'created_by' => 1,
                'min_years_of_experience' => 1,
                'min_level' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Security Officer',
                'code' => 'SO-2024-010',
                'location' => 'Eldoret, Kenya',
                'posts' => 4,
                'deadline' => Carbon::now()->addDays(20),
                'duties_and_responsibilities' => '• Monitor and patrol assigned areas
• Control access to facilities and premises
• Respond to security incidents and emergencies
• Maintain security equipment and systems
• Prepare incident reports and documentation
• Coordinate with law enforcement when necessary
• Conduct security awareness training',
                'requirements' => '• High school diploma or equivalent
• Minimum 2 years experience in security
• Valid security license and certifications
• Physical fitness and ability to work shifts
• Strong observation and reporting skills
• Knowledge of security procedures and protocols',
                'is_published' => 1,
                'created_by' => 1,
                'min_years_of_experience' => 2,
                'min_level' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('job_listings')->insert($jobListings);
    }
}

