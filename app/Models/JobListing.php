<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;
    protected $table ='job_listings';
    protected $fillable = [
        'title',
        'code',
        'location',
        'posts',
        'deadline',
        'duties_and_responsibilities',
        'requirements',
        'is_published',
        'created_by',
        'min_years_of_experience',
        'min_level'
    ];
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function scopeIsPublished($query)
    {
        return $query->where('is_published', 1);
    }
}
