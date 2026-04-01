<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Appartement', 'slug' => 'appartement'],
            ['name' => 'Maison', 'slug' => 'maison'],
            ['name' => 'Villa', 'slug' => 'villa'],
            ['name' => 'Riad', 'slug' => 'riad'],
            ['name' => 'Terrain', 'slug' => 'terrain'],
            ['name' => 'Bureau', 'slug' => 'bureau'],
            ['name' => 'Local Commercial', 'slug' => 'local-commercial'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
