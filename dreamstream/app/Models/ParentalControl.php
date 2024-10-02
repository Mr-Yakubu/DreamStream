<?php

namespace App\Models;

Use Illuminate\Database\Eloquent\Model;

class ParentalControl extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
