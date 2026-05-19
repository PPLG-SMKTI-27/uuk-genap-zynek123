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
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Regular User
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'user',
        ]);

        // Create sample products
        \App\Models\Product::create([
            'name' => 'Laptop',
            'sku' => 'SKU001',
            'description' => 'Laptop berkualitas tinggi',
            'price' => 10000000,
            'stock' => 5,
        ]);

        \App\Models\Product::create([
            'name' => 'Mouse',
            'sku' => 'SKU002',
            'description' => 'Mouse wireless ergonomis',
            'price' => 250000,
            'stock' => 20,
        ]);

        \App\Models\Product::create([
            'name' => 'Keyboard',
            'sku' => 'SKU003',
            'description' => 'Keyboard mechanical RGB',
            'price' => 750000,
            'stock' => 10,
        ]);

        \App\Models\Product::create([
            'name' => 'Monitor',
            'sku' => 'SKU004',
            'description' => 'Monitor 27 inch 4K',
            'price' => 3000000,
            'stock' => 8,
        ]);

        \App\Models\Product::create([
            'name' => 'Headphone',
            'sku' => 'SKU005',
            'description' => 'Headphone wireless premium',
            'price' => 1500000,
            'stock' => 15,
        ]);
    }
}
