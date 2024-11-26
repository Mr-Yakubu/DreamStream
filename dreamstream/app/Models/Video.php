<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['tags', 'title', 'description', 'file_path', 'age_suitability', 'uploaded_by'];

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

    private function generateThumbnail($videoPath)
{
    // Define the thumbnail path based on video filename
    $thumbnailPath = 'thumbnails/' . pathinfo($videoPath, PATHINFO_FILENAME) . '.jpg';

    // Define the full paths for video and thumbnail
    $videoFullPath = storage_path('app/' . $videoPath);
    $thumbnailFullPath = storage_path('app/' . $thumbnailPath);

    // Check if video file exists before attempting to generate a thumbnail
    if (!file_exists($videoFullPath)) {
        throw new \Exception("Video file not found: " . $videoFullPath);
    }

    // Execute FFmpeg command to create the thumbnail
    $ffmpegCommand = "ffmpeg -i " . escapeshellarg($videoFullPath) . " -ss 00:00:01.000 -vframes 1 " . escapeshellarg($thumbnailFullPath);
    exec($ffmpegCommand, $output, $status);

    // Check if the command executed successfully
    if ($status !== 0) {
        throw new \Exception("FFmpeg command failed with status $status. Output: " . implode("\n", $output));
    }

    return $thumbnailPath;
}
}
