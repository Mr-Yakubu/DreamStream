<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentalControl;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ParentalControlController extends Controller
{
    public function parentDashboard()
    {
        $parentId = auth()->id();
        $children = User::where('parent_id', $parentId)->get();
        return view('parent_dashboard', compact('children'));
    }


    public function deleteChildAccount($id)
{
    // Ensure the parent can only delete their child's account
    $parentId = auth()->id(); // Assuming parent is authenticated
    $child = User::where('id', $id)
                ->where('user_type', 'child') // Ensure it's a child account
                ->where('parent_id', $parentId) // Validate relationship (if applicable)
                ->first();

    if (!$child) {
        return redirect()->back()->with('error', 'Unauthorized action or child account not found.');
    }

    $child->delete();

    return redirect()->back()->with('success', 'Child account deleted successfully.');
}

    // Display a dashboard showing children associated with the logged-in parent
    public function index()
    {
        $parentId = auth()->id(); // Get the logged-in parent's ID

        // Retrieve all children associated with the logged-in parent
        $children = User::where('parent_id', $parentId)->get()->map(function ($child) {
            return [
                'id' => $child->id,
                'name' => $child->name,
                'username' => $child->username,
                'videos_watched' => $child->videosWatched->count(),
                'likes' => $child->likes->count(),
                'dislikes' => $child->dislikes->count(),
                'favorites' => $child->favorites->count(),
                'average_watch_time' => $child->videosWatched->avg('duration') ?? 0,
            ];
        });

        return view('parent_dashboard', compact('children'));
    }

    public function childActivityReport($childUserId)
{
    $child = User::findOrFail($childUserId); // Fetch the child record

    // Fetch activity logs or assign an empty array if none exist
    $activityLogs = $child->activityLogs()->orderBy('timestamp', 'desc')->get() ?? [];

    return view('child_activity_report', compact('child', 'activityLogs'));
}

    public function childPerformanceReport($childUserId)
    {
        // Fetch specific child's performance metrics
        $child = User::findOrFail($childUserId);
        $performanceData = [
            'most_watched_genre' => $child->videosWatched->groupBy('genre')->sortDesc()->keys()->first() ?? 'N/A',
            'average_watch_time' => $child->videosWatched->avg('duration') ?? 0,
        ];

        return view('child_performance_report', compact('child', 'performanceData'));
    }






    public function showParentalControls($childUserId)
    {
        return view('parental_controls.show', compact('childUserId'));
    }

    // Display the parental control settings for a specific child
    public function show($childUserId)
    {
        $parentalControl = ParentalControl::where('child_user_id', $childUserId)->first();
        $child = User::find($childUserId);

        if (!$child) {
            return redirect()->back()->withErrors('Child user not found.');
        }

        // If no parental control settings exist, initialize an empty model
        if (!$parentalControl) {
            $parentalControl = new ParentalControl();
            $parentalControl->child_user_id = $childUserId;
        }

        return view('parental_controls', compact('parentalControl', 'childUserId'));
    }

    // Handle the update or creation of parental control settings for a specific child
    public function update(Request $request, $childUserId)
    {
        // Validate the input fields
        $request->validate([
            'age_limit' => 'required|integer|min:0',
            'restricted_keywords' => 'nullable|string',
            'time_limits' => 'nullable|string',
        ]);

        // Retrieve the child user and verify the existence of a parent
        $childUser = User::findOrFail($childUserId);
        if (!$childUser->parent_id) {
            return redirect()->back()->withErrors('No parent associated with this child.');
        }

        // Find the existing parental control settings or create a new one
        $parentalControl = ParentalControl::firstOrNew(['child_user_id' => $childUserId]);

        // Set the `user_id` to the parent's ID and `child_user_id` to the child's ID
        $parentalControl->user_id = $childUser->parent_id; // Associate with the child's parent
        $parentalControl->child_user_id = $childUserId; // Ensure `child_user_id` is set

        // Fill in the other attributes
        $parentalControl->fill($request->only(['age_limit', 'restricted_keywords', 'time_limits']));
        
        // Save the record
        $parentalControl->save();

        // Redirect back with success
        return redirect()->route('parental_controls.show', ['childUserId' => $childUserId])
            ->with('success', 'Parental controls updated.');
    }
}
