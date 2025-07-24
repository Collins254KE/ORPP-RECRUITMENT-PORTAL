<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $table = 'applications';

    protected $fillable = [
        'job_listing_id',
        'user_id',
        'status',
        'updated_by',
    ];

    // Define relationships if needed



    public function jobListing()
{
    return $this->belongsTo(JobListing::class, 'job_listing_id');
}


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
