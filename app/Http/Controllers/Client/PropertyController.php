<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\City;
use App\Models\Category;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with(['city', 'category', 'images'])
            ->where('status', Property::STATUS_ACTIVE);

        // Filters
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->address . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->filled('surface_min')) {
            $query->where('surface', '>=', $request->surface_min);
        }

        if ($request->filled('surface_max')) {
            $query->where('surface', '<=', $request->surface_max);
        }

        if ($request->filled('furnished')) {
            $query->where('furnished', $request->boolean('furnished'));
        }

        $properties = $query->latest()->paginate(12)->withQueryString();

        $cities = City::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('properties.index', compact('properties', 'cities', 'categories'));
    }
}
