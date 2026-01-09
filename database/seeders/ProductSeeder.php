<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        $products = $categories->flatMap(function ($category) {
            return collect(range(1, 5))->map(function ($i) use ($category) {
                return [
                    'category_id' => $category->id,
                    'name' => "{$category->name} Product $i",
                    'description' => "High-quality {$category->name} item number $i.",
                    'price' => rand(100, 2000),
                    'image_url' => 'https://via.placeholder.com/200x200',
                    'stock_quantity' => rand(5, 50),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            });
        })->toArray();

        // إدخال جماعي لجميع المنتجات دفعة واحدة
        Product::insert($products);
    }
}
