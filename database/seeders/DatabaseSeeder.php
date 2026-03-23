<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\City::create(['name' => 'Casablanca', 'region' => 'Casablanca-Settat']);
        \App\Models\City::create(['name' => 'Rabat', 'region' => 'Rabat-Salé-Kénitra']);
        \App\Models\City::create(['name' => 'Marrakech', 'region' => 'Marrakech-Safi']);
    }
}
