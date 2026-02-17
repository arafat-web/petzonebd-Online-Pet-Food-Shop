<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Cat Food',
            'slug' => 'cat-food',
            'cat_image' => 'images/1074592794.jpg',
        ]);

        Category::create([
            'name' => 'Dog Food',
            'slug' => 'dog-food',
            'cat_image' => 'images/1187682359.jpg',
        ]);

        Category::create([
            'name' => 'Bird Food',
            'slug' => 'bird-food',
            'cat_image' => 'images/120800205.jpg',
        ]);

        Category::create([
            'name' => 'Rabbit Food',
            'slug' => 'rabbit-food',
            'cat_image' => 'images/1317079557.jpg',
        ]);
    }
}
