<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            ['name' => 'Casablanca', 'region' => 'Casablanca-Settat'],
            ['name' => 'Rabat', 'region' => 'Rabat-Salé-Kénitra'],
            ['name' => 'Marrakech', 'region' => 'Marrakech-Safi'],
            ['name' => 'Fès', 'region' => 'Fès-Meknès'],
            ['name' => 'Tanger', 'region' => 'Tanger-Tétouan-Al Hoceïma'],
            ['name' => 'Agadir', 'region' => 'Souss-Massa'],
            ['name' => 'Meknès', 'region' => 'Fès-Meknès'],
            ['name' => 'Oujda', 'region' => 'L\'Oriental'],
            ['name' => 'Kénitra', 'region' => 'Rabat-Salé-Kénitra'],
            ['name' => 'Tétouan', 'region' => 'Tanger-Tétouan-Al Hoceïma'],
            ['name' => 'Safi', 'region' => 'Marrakech-Safi'],
            ['name' => 'Mohammédia', 'region' => 'Casablanca-Settat'],
            ['name' => 'Khouribga', 'region' => 'Béni Mellal-Khénifra'],
            ['name' => 'Béni Mellal', 'region' => 'Béni Mellal-Khénifra'],
            ['name' => 'El Jadida', 'region' => 'Casablanca-Settat'],
            ['name' => 'Nador', 'region' => 'L\'Oriental'],
            ['name' => 'Taza', 'region' => 'Fès-Meknès'],
            ['name' => 'Settat', 'region' => 'Casablanca-Settat'],
            ['name' => 'Larache', 'region' => 'Tanger-Tétouan-Al Hoceïma'],
            ['name' => 'Ksar El Kébir', 'region' => 'Tanger-Tétouan-Al Hoceïma'],
            ['name' => 'Errachidia', 'region' => 'Drâa-Tafilalet'],
            ['name' => 'Berrechid', 'region' => 'Casablanca-Settat'],
            ['name' => 'Ouarzazate', 'region' => 'Drâa-Tafilalet'],
            ['name' => 'Essaouira', 'region' => 'Marrakech-Safi'],
            ['name' => 'Taroudant', 'region' => 'Souss-Massa'],
            ['name' => 'Dakhla', 'region' => 'Dakhla-Oued Ed-Dahab'],
            ['name' => 'Laâyoune', 'region' => 'Laâyoune-Sakia El Hamra'],
        ];

        foreach ($cities as $city) {
            City::updateOrCreate(['name' => $city['name']], $city);
        }
    }
}
