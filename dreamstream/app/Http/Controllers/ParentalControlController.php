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

    // Display a dashboard showing children associated with the logged-in parent
    public function index()
{
    $parentId = auth()->id(); // Get the logged-in parent's ID

    // Retrieve all children associated with the logged-in parent
    $children = User::where('parent_id', $parentId)->get();

    // Pass children to the view
    return view('parent_dashboard', compact('children'));
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
            $parentalControl->user_id = $childUserId;
        }

        return view('parental_controls', compact('parentalControl', 'childUserId'));
    }

    // Handle the update or creation of parental control settings for a specific child
    public function update(Request $request, $childUserId)
    {
        // Find the existing parental control settings or create a new one
    $parentalControl = ParentalControl::firstOrNew(['child_user_id' => $childUserId]);

    // Validate the input fields
    $request->validate([
        'age_limit' => 'required|integer|min:0',
        'restricted_keywords' => 'nullable|string',
        'time_limits' => 'nullable|string',
    ]);

    // Update or create the parental control settings
    $parentalControl->fill($request->only(['age_limit', 'restricted_keywords', 'time_limits']));
    $parentalControl->save();

    // Redirect back with success
    return redirect()->route('parental_controls.show', ['childUserId' => $childUserId])->with('success', 'Parental controls updated.');
}
}