<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    // Assuming a video belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $table = 'videos';

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'video_id');
    }
    public function comments()
{
    return $this->hasMany(Comment::class);
}
}
