<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'title' => 'T-Shirt',
            'description' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto, voluptatem.",
            'price' => 1000,
        ]);
        Product::create([
            'title' => 'T-Shirt',
            'description' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto, voluptatem.",
            'price' => 1000,
        ]);
        Product::create([
            'title' => 'T-Shirt',
            'description' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto, voluptatem.",
            'price' => 1000,
        ]);
    }
}
