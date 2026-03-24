<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // ... (existing index code)
    }

    public function stats()
    {
        $user = Auth::user();
        $properties = $user->properties()->withCount('favorites')->get();
        
        return view('owner.stats', compact('properties'));
    }
}
