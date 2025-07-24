<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicRecord extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'qualification_code',
        'qualification_name',
        'qualification_cadre',
        'graduation_date',
        'institution_name',
        'file_path',
        'user_id',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function levelDescription()
    {
        switch ($this->qualification_code) {
            case 1:
                return 'Certificate';
            case 2:
                return 'Diploma';
            case 3:
                return 'Degree';
            case 4:
                return 'Master';
            case 5:
                return 'PhD';
            default:
                return 'Unknown Level';
        }
    }
}
