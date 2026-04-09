<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id'
        ]);

        $user = Auth::user();
        
        $favorite = Favorite::where('user_id', $user->id)
            ->where('property_id', $request->property_id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'property_id' => $request->property_id
            ]);
            return response()->json(['status' => 'added']);
        }
    }

    public function index()
    {
        $favorites = Favorite::with(['property.city', 'property.category', 'property.images'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(12);

        return view('client.favorites', compact('favorites'));
    }
}
