<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $stats = [
            'total_properties' => $user->properties()->count(),
            'active_listings' => $user->properties()->where('status', 'available')->count(),
            'total_views' => $user->properties()->sum('views_count'),
            'favorites_count' => $user->properties()->withCount('favorites')->get()->sum('favorites_count'),
        ];

        $recentProperties = $user->properties()
            ->latest()
            ->limit(5)
            ->get();

        return view('owner.dashboard', compact('stats', 'recentProperties'));
    }
}
