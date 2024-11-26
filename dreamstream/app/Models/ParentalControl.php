<?php

namespace App\Models;

Use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParentalControl extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'user_id',       
        'age_limit',
        'restricted_keywords',
        'time_limits',
    ];

    protected $casts = [
        'restricted_keywords' => 'array', 
    ];


    public function child()
    {
        return $this->belongsTo(User::class, 'child_user_id'); // child_user_id is the foreign key for child
    }
    

    // ParentalControl model

    public function user()
    {
    return $this->belongsTo(User::class, 'child_user_id');
    }
}
