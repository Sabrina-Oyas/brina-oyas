<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. CRÉATION D'UN COMPTE ADMIN
        User::factory()->create([
            'name' => 'Admin Brina',
            'email' => 'admin@brina.com',
            'password' => Hash::make('password'), 
        ]);

        // 2. CRÉATION DES CATÉGORIES
        $categories = [
            ['name' => 'Oyas à planter'],
            ['name' => 'Oyas à enterrer'],
            ['name' => 'Pots en terre cuite'],
            ['name' => 'Accessoires de jardinage'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // 3. CRÉATION DE 50 PRODUITS ALÉATOIRES
        Product::factory(50)->create();
    }
}