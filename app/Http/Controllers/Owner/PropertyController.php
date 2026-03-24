<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $types = ['appartement', 'maison', 'villa', 'riad', 'terrain', 'bureau'];
        return view('owner.properties.create', compact('cities', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'surface' => ['required', 'integer', 'min:1'],
            'rooms' => ['required', 'integer', 'min:0'],
            'furnished' => ['required', 'boolean'],
            'city_id' => ['required', 'exists:cities,id'],
            'description' => ['nullable', 'string'],
        ]);

        $property = Auth::user()->properties()->create($request->all());

        return redirect()->route('owner.properties.index')
            ->with('success', 'Propriété ajoutée avec succès. Vous pouvez maintenant ajouter des images.');
    }

    public function show(Property $property)
    {
        $this->authorizeOwner($property);
        return view('owner.properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        $this->authorizeOwner($property);
        $cities = City::all();
        $types = ['appartement', 'maison', 'villa', 'riad', 'terrain', 'bureau'];
        return view('owner.properties.edit', compact('property', 'cities', 'types'));
    }

    public function update(Request $request, Property $property)
    {
        $this->authorizeOwner($property);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'surface' => ['required', 'integer', 'min:1'],
            'rooms' => ['required', 'integer', 'min:0'],
            'furnished' => ['required', 'boolean'],
            'city_id' => ['required', 'exists:cities,id'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:available,sold,rented'],
        ]);

        $property->update($request->all());

        return redirect()->route('owner.properties.index')
            ->with('success', 'Propriété mise à jour avec succès.');
    }

    public function destroy(Property $property)
    {
        $this->authorizeOwner($property);
        $property->delete();

        return back()->with('success', 'Propriété supprimée avec succès.');
    }

    private function authorizeOwner(Property $property)
    {
        if ($property->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
