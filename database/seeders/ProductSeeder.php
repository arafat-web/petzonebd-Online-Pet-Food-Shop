<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            // Cat Food Products
            [
                'name' => 'Royal Canin Cat Food',
                'cat_id' => 1,
                'brand' => 'Royal Canin',
                'price' => '2500',
                'discount_price' => '2200',
                'description' => 'Premium cat food for healthy growth',
                'image' => 'images/1074592794.jpg',
            ],
            [
                'name' => 'Whiskas Cat Food',
                'cat_id' => 1,
                'brand' => 'Whiskas',
                'price' => '1500',
                'discount_price' => '1300',
                'description' => 'Tasty and nutritious cat food',
                'image' => 'images/1078422474.jpg',
            ],
            [
                'name' => 'Felix Cat Food',
                'cat_id' => 1,
                'brand' => 'Felix',
                'price' => '1800',
                'discount_price' => '1600',
                'description' => 'Complete nutrition for cats',
                'image' => 'images/1031851231.jpg',
            ],
            [
                'name' => 'Sheba Delite',
                'cat_id' => 1,
                'brand' => 'Sheba',
                'price' => '2000',
                'discount_price' => '1750',
                'description' => 'Gourmet cat food selection',
                'image' => 'images/1392318635.jpg',
            ],
            // Dog Food Products
            [
                'name' => 'Pedigree Dog Food',
                'cat_id' => 2,
                'brand' => 'Pedigree',
                'price' => '3000',
                'discount_price' => '2700',
                'description' => 'Complete and balanced dog food',
                'image' => 'images/1187682359.jpg',
            ],
            [
                'name' => 'Drools Dog Food',
                'cat_id' => 2,
                'brand' => 'Drools',
                'price' => '2200',
                'discount_price' => '1950',
                'description' => 'Nutritious dog food with meat',
                'image' => 'images/1317079557.jpg',
            ],
            [
                'name' => 'Chappi Dog Food',
                'cat_id' => 2,
                'brand' => 'Chappi',
                'price' => '1800',
                'discount_price' => '1600',
                'description' => 'Affordable dog food choice',
                'image' => 'images/1609537941.jpg',
            ],
            [
                'name' => 'Cesar Dog Food',
                'cat_id' => 2,
                'brand' => 'Cesar',
                'price' => '2800',
                'discount_price' => '2500',
                'description' => 'Premium dog food for small breeds',
                'image' => 'images/530638277.jpg',
            ],
            // Bird Food Products
            [
                'name' => 'Kaytee Bird Food',
                'cat_id' => 3,
                'brand' => 'Kaytee',
                'price' => '800',
                'discount_price' => '700',
                'description' => 'Complete nutrition for birds',
                'image' => 'images/120800205.jpg',
            ],
            [
                'name' => 'Trill Bird Seed Mix',
                'cat_id' => 3,
                'brand' => 'Trill',
                'price' => '600',
                'discount_price' => '500',
                'description' => 'High quality bird seed mix',
                'image' => 'images/2132186220.jpg',
            ],
            [
                'name' => 'Vitakraft Bird Food',
                'cat_id' => 3,
                'brand' => 'Vitakraft',
                'price' => '900',
                'discount_price' => '800',
                'description' => 'Nutritious bird food pellets',
                'image' => 'images/31356886.jpg',
            ],
            [
                'name' => 'Harrison Bird Food',
                'cat_id' => 3,
                'brand' => 'Harrison',
                'price' => '1200',
                'discount_price' => '1000',
                'description' => 'Organic bird food',
                'image' => 'images/330705464.jpg',
            ],
            // Rabbit Food Products
            [
                'name' => 'Supreme Rabbit Food',
                'cat_id' => 4,
                'brand' => 'Supreme',
                'price' => '1500',
                'discount_price' => '1300',
                'description' => 'Complete rabbit food mix',
                'image' => 'images/575940308.jpg',
            ],
            [
                'name' => 'Oxbow Rabbit Pellets',
                'cat_id' => 4,
                'brand' => 'Oxbow',
                'price' => '2000',
                'discount_price' => '1800',
                'description' => 'Premium rabbit pellets',
                'image' => 'images/723210119.jpg',
            ],
            [
                'name' => 'Vitakraft Rabbit Food',
                'cat_id' => 4,
                'brand' => 'Vitakraft',
                'price' => '1200',
                'discount_price' => '1000',
                'description' => 'Varied rabbit food',
                'image' => 'images/330705464.jpg',
            ],
            [
                'name' => 'Bunny Nibbles',
                'cat_id' => 4,
                'brand' => 'Burgess',
                'price' => '1300',
                'discount_price' => '1100',
                'description' => 'High fiber rabbit food',
                'image' => 'images/825145418.png',
            ],
        ];

        foreach ($products as $index => $productData) {
            $productData['slug'] = Str::slug($productData['name']) . '-' . ($index + 1);
            Product::create($productData);
        }
    }
}
