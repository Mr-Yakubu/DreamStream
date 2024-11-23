<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use App\Models\ActivityLog; 

class User extends Authenticatable 
{
    use Notifiable; // Use Notifiable trait for notifications

    protected $fillable = [
        'username', 'name', 'email', 'password', 'user_type', 'date', 'remember_token', // Mass assignable
    ];

    protected $hidden = [
        'password', 'remember_token', 
    ];

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class, 'user_id', 'id');
    }

    public function parent()
{
    return $this->belongsTo(User::class, 'parent_id');  // A child belongs to a parent
}




public function parentalControl()
    {
        // A user has one parental control
        return $this->hasOne(ParentalControl::class, 'user_id'); // Assuming user_id is the foreign key
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

    // Additional method for password verification
    public function getAuthPassword()
    {
        return $this->password; // This is used for authentication
    }
}
