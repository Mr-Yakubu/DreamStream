<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EnsureUserIsParent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Log the user's authentication status and user_type for debugging
        Log::info('User authenticated: ' . (Auth::check() ? 'Yes' : 'No'));
        Log::info('User user_type: ' . Auth::user()->user_type);

        // Check if the user is authenticated and has the 'parent' user_type
        if (Auth::check() && Auth::user()->user_type == 'parent') {
            return $next($request);
        }

        // Log the redirection event
        Log::info('Redirecting non-parent user to home page.');

        // Redirect to a different page if the user is not a parent
        return redirect()->route('home')->with('error', 'You do not have access to this page.');
    }
}
