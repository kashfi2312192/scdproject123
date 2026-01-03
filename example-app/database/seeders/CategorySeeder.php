<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Rings',
                'slug' => 'rings',
                'description' => 'Beautiful rings collection',
            ],
            [
                'name' => 'Bracelets',
                'slug' => 'bracelets',
                'description' => 'Elegant bracelets collection',
            ],
            [
                'name' => 'Earrings',
                'slug' => 'earrings',
                'description' => 'Stylish earrings collection',
            ],
            [
                'name' => 'Necklaces',
                'slug' => 'necklaces',
                'description' => 'Gorgeous necklaces collection',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}

