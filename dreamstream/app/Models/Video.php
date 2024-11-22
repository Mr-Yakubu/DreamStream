<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['tags', 'title', 'description', 'file_path'];

    protected $table = 'videos';

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');  // Specify 'uploaded_by' as the foreign key
    }

    public function showManageVideos()
{
    
    return $this->belongsTo(User::class, 'uploaded_by'); // Pass videos to the view
}

    // Relationship with User (Uploader)
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Relationship with Favorites
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'video_id');
    }

    // Relationship with Comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Accessor for the 'tags' attribute (converts the comma-separated string into an array)
    public function getTagsAttribute($value)
    {
        return explode(', ', $value);  // Convert the string to an array when accessed
    }

    // Mutator for the 'tags' attribute (converts array into a comma-separated string)
    public function setTagsAttribute($value)
    {
        $this->attributes['tags'] = implode(', ', (array) $value);  // Convert array to comma-separated string when saving
    }

    /**
     * Filter videos based on parental control restrictions
     */
    public static function filterVideosByParentalControl($userId)
    {
        // Fetch the parental control for the given user
        $parentalControl = ParentalControl::where('user_id', $userId)->first();

        if ($parentalControl) {
            // Get the restricted keywords
            $restrictedKeywords = $parentalControl->restricted_keywords;

            // Filter videos based on restricted keywords in the title or description
            return self::where(function ($query) use ($restrictedKeywords) {
                foreach ($restrictedKeywords as $keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')
                          ->orWhere('description', 'like', '%' . $keyword . '%');
                }
            });
        }

        // If no parental control is found, return all videos
        return self::all();
    }
}
