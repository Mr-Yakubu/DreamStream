<?php

namespace App\Models;

Use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParentalControl extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'user_id',        // Make sure user_id is also fillable
        'age_limit',
        'restricted_keywords',
        'time_limits',
    ];

    // In User model
public function parentalControl()
{
    return $this->hasOne(ParentalControl::class, 'child_user_id');
}

    // In ParentalControl model
public function user()
{
    return $this->belongsTo(User::class, 'child_user_id');
}
}
