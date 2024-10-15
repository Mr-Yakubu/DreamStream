<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // Import the Authenticatable class
use Illuminate\Notifications\Notifiable; // Import Notifiable trait

class User extends Authenticatable // Extend Authenticatable instead of Model
{
    use Notifiable; // Use Notifiable trait for notifications

    protected $fillable = [
        'name', 'email', 'password', // Make these fields mass assignable
    ];

    protected $hidden = [
        'password', 'remember_token', // Hide these fields when serializing
    ];

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
