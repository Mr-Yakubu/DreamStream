<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function media()
    {
        return $this->hasMany(Media::class);
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
}
