<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referee extends Model
{
    use HasFactory;
    protected $fillable = [
    'first_name',
    'middle_name',
    'other_name',
    'organization',
    'designation',
    'postal_address',
    'postal_code',
    'city_town',
    'referee_type',
    'email', 
    'mobile_phone', 
    'user_id',
];


    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
