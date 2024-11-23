<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

 
    protected $table = 'monitoring_logs';

    // The columns in the table.

    protected $fillable = [
        'action', // the action that was performed
        'details', // details about the action
        'user_id', // the user who performed the action
        'timestamp', // the timestamp of the activity
    ];

  
}
