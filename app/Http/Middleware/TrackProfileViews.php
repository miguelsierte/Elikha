<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ProfileView; // Assuming you have a ProfileView model

class TrackProfileViews
{
    public function handle($request, Closure $next)
    {
        // Logic to record the profile view
        ProfileView::create([
            'profile_id' => $profileId, // Set this to the profile being viewed
            'viewer_id' => auth()->id(), // If you want to record the viewer's ID
            'viewed_at' => now(),
        ]);

        return $next($request);
    }
}

