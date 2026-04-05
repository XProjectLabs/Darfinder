<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'root@darfinder.ma'],
            [
                'name' => 'Admin Darfinder',
                'password' => \Illuminate\Support\Facades\Hash::make('root1234'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );
    }
}
