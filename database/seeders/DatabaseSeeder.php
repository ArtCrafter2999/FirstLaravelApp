<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin'
        ]);
        Category::factory()->create([
             'name' => 'Test Category',
             'description' => null,
         ]);
        Category::factory()->create([
            'name' => 'Test Category 2',
            'description' => null,
        ]);
        Product::factory(10)->create();
        Tag::factory(10)->create();
    }
}
