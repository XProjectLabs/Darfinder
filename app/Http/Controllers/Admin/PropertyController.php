<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Property::with(['city', 'category', 'user'])
            ->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by city
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $properties = $query->paginate(12);
        
        $stats = [
            'pending' => Property::where('status', Property::STATUS_PENDING)->count(),
            'active' => Property::where('status', Property::STATUS_ACTIVE)->count(),
            'rejected' => Property::where('status', Property::STATUS_REJECTED)->count(),
        ];

        return view('admin.properties.index', compact('properties', 'stats'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $property->load(['images', 'city', 'category', 'user']);
        return view('admin.properties.show', compact('property'));
    }

    /**
     * Approve the property.
     */
    public function approve(Property $property)
    {
        $property->update(['status' => Property::STATUS_ACTIVE]);
        return redirect()->route('admin.properties.index')
            ->with('success', 'L\'annonce a été approuvée avec succès et est maintenant en ligne.');
    }

    /**
     * Reject the property.
     */
    public function reject(Property $property)
    {
        $property->update(['status' => Property::STATUS_REJECTED]);
        return redirect()->route('admin.properties.index')
            ->with('success', 'L\'annonce a été refusée.');
    }
}
