<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Auth::user()->properties()
            ->with('city')
            ->latest()
            ->paginate(10);

        return view('owner.properties.index', compact('properties'));
    }

    public function create()
    {
        $cities = City::all();
        $categories = Category::all();
        return view('owner.properties.create', compact('cities', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'surface' => ['required', 'integer', 'min:1'],
            'rooms' => ['required', 'integer', 'min:0'],
            'furnished' => ['required', 'boolean'],
            'city_id' => ['required', 'exists:cities,id'],
            'description' => ['nullable', 'string'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $property = Auth::user()->properties()->create($request->except('images'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('properties', 'public');
                $property->images()->create([
                    'path' => $path,
                    'is_primary' => $index === 0, // First image is primary by default if not specified
                ]);
            }
        }

        return redirect()->route('owner.properties.index')
            ->with('success', 'Propriété ajoutée avec succès.');
    }

    public function show(Property $property)
    {
        $this->authorizeOwner($property);
        $property->load('images');
        return view('owner.properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        $this->authorizeOwner($property);
        $property->load('images');
        $cities = City::all();
        $categories = Category::all();
        return view('owner.properties.edit', compact('property', 'cities', 'categories'));
    }

    public function update(Request $request, Property $property)
    {
        $this->authorizeOwner($property);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'surface' => ['required', 'integer', 'min:1'],
            'rooms' => ['required', 'integer', 'min:0'],
            'furnished' => ['required', 'boolean'],
            'city_id' => ['required', 'exists:cities,id'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,active,rejected'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $property->update($request->except('images'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                $property->images()->create([
                    'path' => $path,
                    'is_primary' => !$property->images()->where('is_primary', true)->exists(),
                ]);
            }
        }

        return redirect()->route('owner.properties.index')
            ->with('success', 'Propriété mise à jour avec succès.');
    }


    public function destroy(Property $property)
    {
        $this->authorizeOwner($property);
        $property->delete();

        return back()->with('success', 'Propriété supprimée avec succès.');
    }

    public function deleteImage(\App\Models\PropertyImage $image)
    {
        $this->authorizeOwner($image->property);
        
        \Storage::disk('public')->delete($image->path);
        
        if ($image->is_primary) {
            $image->delete();
            $nextImage = $image->property->images()->first();
            if ($nextImage) {
                $nextImage->update(['is_primary' => true]);
            }
        } else {
            $image->delete();
        }

        return back()->with('success', 'Image supprimée.');
    }

    public function setPrimaryImage(\App\Models\PropertyImage $image)
    {
        $this->authorizeOwner($image->property);
        
        $image->property->images()->update(['is_primary' => false]);
        $image->update(['is_primary' => true]);

        return back()->with('success', 'Image principale mise à jour.');
    }

    private function authorizeOwner(Property $property)
    {
        if ($property->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
