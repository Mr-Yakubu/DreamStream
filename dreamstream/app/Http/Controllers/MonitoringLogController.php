<?php

namespace App\Http\Controllers;

use App\Models\MonitoringLog;
use Illuminate\Http\Request;

class MonitoringLogController extends Controller
{
    // Display the user activity logs
    public function showUserActivity()
    {
        $userId = auth()->user()->id; // Get the current logged-in user's ID

        // Fetch the latest 10 activity logs for the user
        $activities = MonitoringLog::where('user_id', $userId)
                                   ->orderBy('created_at', 'desc')
                                   ->take(10)
                                   ->get();

        // Return a view with the activities
        return view('user.activity', compact('activities'));
    }

    // Log a new user activity
    public function logActivity(Request $request)
    {
        $userId = auth()->user()->id;

        // Store the new log entry in the database
        MonitoringLog::create([
            'user_id' => $userId,
            'action' => $request->action,
            'details' => $request->details,
        ]);

        // You can redirect or return a response
        return redirect()->back()->with('status', 'Activity logged successfully!');
    }
    public function uploadVideo(Request $request)
    {
    // Video upload logic here

    // Log the user activity in the monitoring_logs table
    MonitoringLog::create([
        'user_id' => auth()->user()->id,
        'action' => 'Video Upload',
        'details' => 'User uploaded a new video: ' . $request->video_title
    ]);

    return redirect()->route('video.upload.success');
    }
}
