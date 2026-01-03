<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        // Get categories
        $categories = Category::all()->keyBy('name');
        
        Product::query()->delete();

        $products = [
            [
                'name' => 'Silver Cat Stud Earrings',
                'description' => 'Adorable cat outline earrings crafted in sterling silver with a sleek, modern design.',
                'price' => 2200,
                'image' => 'img/products/silver-cat-stud-earrings.webp',
                'category_id' => $categories['Earrings']->id ?? null,
                'slug' => Str::slug('Silver Cat Stud Earrings'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Gold Link Chain Bracelet',
                'description' => 'Modern layered bracelet featuring a double paperclip chain design with adjustable closure.',
                'price' => 5500,
                'image' => 'img/products/gold-link-chain-bracelet.webp',
                'category_id' => $categories['Bracelets']->id ?? null,
                'slug' => Str::slug('Gold Link Chain Bracelet'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Daisy Flower Band Ring',
                'description' => 'Delicate sterling silver band ring featuring blooming daisies with golden centers.',
                'price' => 3200,
                'image' => 'img/products/daisy-flower-band-ring.webp',
                'category_id' => $categories['Rings']->id ?? null,
                'slug' => Str::slug('Daisy Flower Band Ring'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Minimalist Double Loop Necklace',
                'description' => 'Elegant minimalist necklace featuring two interlocking rings with crystal accents.',
                'price' => 4200,
                'image' => 'img/products/minimalist-double-loop-necklace.webp',
                'category_id' => $categories['Necklaces']->id ?? null,
                'slug' => Str::slug('Minimalist Double Loop Necklace'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Rainbow Charm Bracelet',
                'description' => 'Vibrant stainless steel bracelet with rainbow-striped beads and playful charms.',
                'price' => 4500,
                'image' => 'img/products/rainbow-charm-bracelet.webp',
                'category_id' => $categories['Bracelets']->id ?? null,
                'slug' => Str::slug('Rainbow Charm Bracelet'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Moonstone Crescent Ring',
                'description' => 'Mystical adjustable ring featuring an iridescent moonstone orb and crystal crescent moon.',
                'price' => 4100,
                'image' => 'img/products/moonstone-crescent-ring.webp',
                'category_id' => $categories['Rings']->id ?? null,
                'slug' => Str::slug('Moonstone Crescent Ring'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Diamond Solitaire Pendant',
                'description' => 'Classic diamond necklace with a brilliant cut stone set in white gold.',
                'price' => 6800,
                'image' => 'img/products/diamond-solitaire-pendant.png',
                'category_id' => $categories['Necklaces']->id ?? null,
                'slug' => Str::slug('Diamond Solitaire Pendant'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Turquoise Stone Boho Necklace',
                'description' => 'Boho-inspired necklace with raw turquoise stone wrapped in gold wire on leather cord.',
                'price' => 3900,
                'image' => 'img/products/turquoise-stone-boho-necklace.png',
                'category_id' => $categories['Necklaces']->id ?? null,
                'slug' => Str::slug('Turquoise Stone Boho Necklace'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        Product::insert($products);
    }
}
