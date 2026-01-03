<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class UpdateProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This updates existing products to have category_id based on product name keywords.
     */
    public function run(): void
    {
        $categories = Category::all()->keyBy('name');
        
        // Update products based on name keywords
        Product::whereNull('category_id')->chunk(100, function ($products) use ($categories) {
            foreach ($products as $product) {
                $categoryId = null;
                
                // Check product name for category keywords
                $name = strtolower($product->name);
                
                if (str_contains($name, 'earring')) {
                    $categoryId = $categories['Earrings']->id ?? null;
                } elseif (str_contains($name, 'bracelet')) {
                    $categoryId = $categories['Bracelets']->id ?? null;
                } elseif (str_contains($name, 'ring') && !str_contains($name, 'necklace') && !str_contains($name, 'earring')) {
                    $categoryId = $categories['Rings']->id ?? null;
                } elseif (str_contains($name, 'necklace') || str_contains($name, 'pendant')) {
                    $categoryId = $categories['Necklaces']->id ?? null;
                }
                
                // Also check old category field if it exists
                if (!$categoryId && !empty($product->category)) {
                    $oldCategory = ucfirst(strtolower($product->category));
                    if (isset($categories[$oldCategory])) {
                        $categoryId = $categories[$oldCategory]->id;
                    }
                }
                
                if ($categoryId) {
                    $product->update(['category_id' => $categoryId]);
                }
            }
        });
    }
}

