<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // Import the Authenticatable class
use Illuminate\Notifications\Notifiable; // Import Notifiable trait

class User extends Authenticatable // Extend Authenticatable instead of Model
{
    use Notifiable; // Use Notifiable trait for notifications

    protected $fillable = [
        'username', 'name', 'email', 'password', // Make these fields mass assignable
    ];

    protected $hidden = [
        'password', 'remember_token', // Hide these fields when serializing
    ];

    public function parent()
{
    return $this->belongsTo(User::class, 'parent_id');  // A child belongs to a parent
}

// For child to parent relationship
public function parentControl()
{
    return $this->hasOne(ParentalControl::class, 'child_user_id');
}


public function children()
{
    return $this->hasMany(ParentalControl::class, 'parent_id');  // A parent can have multiple children
}

    public function videos()
    {
        return $this->hasMany(Video::class, 'uploaded_by'); // Reference the uploaded_by column
    }

    public function logs()
    {
        return $this->hasMany(MonitoringLog::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }
    
    public function parentalControl()
    {
        return $this->hasOne(ParentalControl::class);
    }

    // Additional method for password verification
    public function getAuthPassword()
    {
        return $this->password; // This is used for authentication
    }
}
