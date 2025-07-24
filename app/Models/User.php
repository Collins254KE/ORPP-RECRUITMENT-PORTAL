<?php

namespace App\Models;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
// Related models

use App\Models\Biodata;
use App\Models\AcademicRecord;
use App\Models\EmploymentHistory;
use App\Models\ProfessionalMembership;
use App\Models\ProfessionalQualification;
use App\Models\Referee;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'title',
        'phone',
        'id_passport',
        'kra_pin',
        'email',
        'password',
        'county',
        'sub_county',
        'ward',
        'ethnicity',
        'nationality',
        'gender',
        'dob',
        'disability_status',
        'disability_certificate_number',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
         'is_admin' => 'boolean'
    ];

    // Relationships
    // public function biodata()
    // {
    //     return $this->hasOne(Biodata::class);
    // }

    public function academicRecords()
    {
        return $this->hasMany(AcademicRecord::class);
    }

    public function employmentHistory()
    {
        return $this->hasMany(EmploymentHistory::class);
    }

    public function professionalMemberships()
    {
        return $this->hasMany(ProfessionalMembership::class);
    }

    public function professionalQualifications()
    {
        return $this->hasMany(ProfessionalQualification::class);
    }

    public function referees()
    {
        return $this->hasMany(Referee::class);
    }

    /**
     * Checks if the profile is completely filled out.
     *
     * @return bool
     */
    public function isProfileComplete()
    {
        $hasDisability = $this->disability_status === 'yes';

        return !(
            $this->academicRecords->isEmpty() ||
            $this->professionalQualifications->isEmpty() ||
            $this->employmentHistory->isEmpty() ||
            $this->referees->isEmpty() ||
            empty($this->name) ||
            empty($this->dob) ||
            empty($this->gender) ||
            empty($this->nationality) ||
            empty($this->ethnicity) ||
            empty($this->county) ||
            empty($this->sub_county) ||
             empty($this->ward) ||
            empty($this->id_passport) ||
            empty($this->kra_pin) ||
            empty($this->phone) ||
            empty($this->disability_status) ||
            ($hasDisability && empty($this->disability_certificate_number))
        );
    }

    /**
     * Returns profile completeness percentage.
     *
     * @return int Percentage (0–100)
     */
    public function profileCompleteness()
    {
        $fields = [
            'name', 'dob', 'gender', 'nationality', 'ethnicity',
            'county', 'sub_county',  'ward','id_passport', 'kra_pin', 'phone', 'disability_status', 'disability_certificate_number',
        ];

        $completed = 0;

        foreach ($fields as $field) {
            if (!empty($this->$field)) {
                $completed++;
            }
        }

        // Disability certificate logic
        if ($this->disability_status === 'yes') {
            if (!empty($this->disability_certificate_number)) {
                $completed++;
            }
        } else {
            $completed++; // counts as complete if not disabled
        }

        // Relation checks
        $relations = [
            'academicRecords',
            'professionalQualifications',
            'employmentHistory',
            'referees',
        ];

        foreach ($relations as $relation) {
            if ($this->$relation()->exists()) {
                $completed++;
            }
        }

        $total = count($fields) + 1 + count($relations); // 1 for disability logic
        return round(($completed / $total) * 100);
    }

    /**
     * Returns total number of years of experience
     * 
     * @return int Years
     */
    public function experienceYears()
    {
        $totalMonths = 0;
        foreach ($this->employmentHistory as $emp) {
            try 
            {
                $start = $emp->date_joined ? Carbon::parse($emp->date_joined) : null;
                $end = $emp->date_left ? Carbon::parse($emp->date_left) : Carbon::now();
                if ($start) {
                    $totalMonths += $end->diffInMonths($start);
                }
            } 
            catch (\Exception $e) 
            {
                continue;
            }
        }
        return ($totalMonths / 12);
    }
public function sendEmailVerificationNotification()
{
    $this->notify(new CustomVerifyEmail);
}
    /**
     * Get the user's highest qualification level as a numeric rank.
     *
     * @return int
     */
    public function getHighestQualificationRank()
    {
        
        $highestRank = 0;

        $academicQualifications = $this->academicRecords->pluck('qualification_code');
        $professionalQualifications = $this->professionalQualifications->pluck('level');

        $allQualifications = $academicQualifications->concat($professionalQualifications);
        
        foreach ($allQualifications as $qualificationName) {
            if ($qualificationName > $highestRank) {
                $highestRank = $qualificationName;
            }
        }
        
        return $highestRank;
    }

    /**
     * Check if user meets minimum requirements for a job
     * 
     * @param JobListing $job
     * @return array ['eligible' => bool, 'reasons' => array]
     */
   public function meetsJobRequirements($job)
{
    $reasons = [];
    $eligible = true;

    // Check if profile is complete
    if (!$this->isProfileComplete()) {
        $eligible = false;
        $reasons[] = 'Dear applicant, your profile is incomplete. Please update all required sections.';
    }

    // Combined check for qualifications and experience
    if (
        ($job->min_level && $this->getHighestQualificationRank() < $job->min_level) ||
        ($job->min_years_of_experience && $this->experienceYears() < $job->min_years_of_experience)
    ) {
        $eligible = false;
        $reasons[] = 'You do not qualify for this job.';
    }

    return [
        'eligible' => $eligible,
        'reasons' => $reasons
    ];
}

}
