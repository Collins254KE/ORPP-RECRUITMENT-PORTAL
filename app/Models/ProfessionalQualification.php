<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalQualification extends Model
{
    use HasFactory;
    protected $fillable = [
        'level',
        'description',
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
        switch ($this->level) {
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
