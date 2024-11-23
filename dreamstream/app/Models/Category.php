<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'categories';

    // The attributes that are mass assignable
    protected $fillable = ['name'];

    // The attributes that should be hidden for arrays (if needed)
    protected $hidden = [];

    // If you need to get related videos, you can define a relationship here
    public function videos()
    {
        return $this->belongsToMany(Video::class); // Assuming you have a pivot table for many-to-many relation
    }
    
}
