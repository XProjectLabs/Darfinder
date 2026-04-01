<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CityController extends Controller
{
    protected $regions = [
        'Tanger-Tétouan-Al Hoceïma',
        'L\'Oriental',
        'Fès-Meknès',
        'Rabat-Salé-Kénitra',
        'Béni Mellal-Khénifra',
        'Casablanca-Settat',
        'Marrakech-Safi',
        'Drâa-Tafilalet',
        'Souss-Massa',
        'Guelmim-Oued Noun',
        'Laâyoune-Sakia El Hamra',
        'Dakhla-Oued Ed-Dahab',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::withCount('properties')->latest()->paginate(10);
        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = $this->regions;
        return view('admin.cities.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cities,name',
            'region' => 'required|string|max:255',
        ]);

        City::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'region' => $request->region,
        ]);

        return redirect()->route('admin.cities.index')
            ->with('success', 'Ville ajoutée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        $regions = $this->regions;
        return view('admin.cities.edit', compact('city', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cities,name,' . $city->id,
            'region' => 'required|string|max:255',
        ]);

        $city->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'region' => $request->region,
        ]);

        return redirect()->route('admin.cities.index')
            ->with('success', 'Ville mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        if ($city->properties()->exists()) {
            return back()->with('error', 'Impossible de supprimer cette ville car elle contient des annonces.');
        }

        if ($city->users()->exists()) {
            return back()->with('error', 'Impossible de supprimer cette ville car elle est associée à des utilisateurs.');
        }

        $city->delete();

        return redirect()->route('admin.cities.index')
            ->with('success', 'Ville supprimée avec succès.');
    }
}
