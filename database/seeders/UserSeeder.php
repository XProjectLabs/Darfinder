<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = \App\Models\City::pluck('id')->toArray();

        // Create 5 Owners
        foreach (range(1, 5) as $i) {
            \App\Models\User::create([
                'name' => "Propriétaire $i",
                'email' => "owner$i@example.com",
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'propriétaire',
                'phone' => '060000000' . $i,
                'is_active' => true,
                'city_id' => $cities[array_rand($cities)],
            ]);
        }

        // Create 10 Tenants
        foreach (range(1, 10) as $i) {
            \App\Models\User::create([
                'name' => "Locataire $i",
                'email' => "tenant$i@example.com",
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'locataire',
                'phone' => '070000000' . $i,
                'is_active' => true,
                'city_id' => $cities[array_rand($cities)],
            ]);
        }
    }
}
