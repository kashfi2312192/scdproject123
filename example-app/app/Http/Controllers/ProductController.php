<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Jewelry product data
    public function productData()
    {
        return [
            [
                'slug' => 'silver-cat-stud-earrings',
                'name' => 'Silver Cat Stud Earrings',
                'price' => 2200,
                'old_price' => 2800,
                'discount' => 21,
                'image' => 'products/silver-cat-stud-earrings.webp',
                'short' => 'Minimalist cat silhouette studs in polished silver.',
                'description' => 'Adorable cat outline earrings perfect for feline lovers. Crafted in sterling silver with a sleek, modern design.',
                'stock' => 15,
                'sku' => 'E-001',
                'category' => 'Earrings',
                'tags' => ['Silver', 'Cat', 'Minimalist'],
            ],
            [
                'slug' => 'gold-link-chain-bracelet',
                'name' => 'Gold Link Chain Bracelet',
                'price' => 5500,
                'old_price' => 6200,
                'discount' => 11,
                'image' => 'products/gold-link-chain-bracelet.webp',
                'short' => 'Double-layer paperclip chain bracelet in gold tone.',
                'description' => 'Modern layered bracelet featuring paperclip chain design with adjustable slider closure. Perfect for everyday elegance.',
                'stock' => 12,
                'sku' => 'B-001',
                'category' => 'Bracelets',
                'tags' => ['Gold', 'Chain', 'Layered', 'Modern'],
            ],
            [
                'slug' => 'dinosaur-dangle-earrings',
                'name' => 'Dinosaur Dangle Earrings',
                'price' => 2800,
                'old_price' => 3500,
                'discount' => 20,
                'image' => 'products/dinosaur-dangle-earrings.webp',
                'short' => 'Playful teal dinosaur enamel earrings with gold hooks.',
                'description' => 'Whimsical dinosaur earrings in deep teal enamel with cream belly detail. Perfect for adding fun to any outfit.',
                'stock' => 10,
                'sku' => 'E-002',
                'category' => 'Earrings',
                'tags' => ['Gold', 'Dinosaur', 'Modern'],
            ],
            [
                'slug' => 'daisy-flower-band-ring',
                'name' => 'Daisy Flower Band Ring',
                'price' => 3200,
                'old_price' => 3800,
                'discount' => 16,
                'image' => 'products/daisy-flower-band-ring.webp',
                'short' => 'Sterling silver ring with daisy flowers and gold centers.',
                'description' => 'Delicate band ring featuring four blooming daisies in silver petals with golden centers. Stamped S925 for authenticity.',
                'stock' => 18,
                'sku' => 'R-001',
                'category' => 'Rings',
                'tags' => ['Silver', 'Gold', 'Floral','Minimalist'],
            ],
            [
                'slug' => 'heart-initial-open-ring',
                'name' => 'Heart Initial Open Ring',
                'price' => 2900,
                'old_price' => 3400,
                'discount' => 15,
                'image' => 'products/heart-initial-open-ring.webp',
                'short' => 'Adjustable gold ring with crystal heart and letter charm.',
                'description' => 'Personalized open ring featuring a sparkling heart-cut crystal and customizable initial letter. Perfect gift for loved ones.',
                'stock' => 20,
                'sku' => 'R-002',
                'category' => 'Rings',
                'tags' => ['Gold', 'Heart', 'Crystal', 'Classic','Minimalist'],
            ],
            [
                'slug' => 'minimalist-double-loop-necklace',
                'name' => 'Minimalist Double Loop Necklace',
                'price' => 4200,
                'old_price' => 4800,
                'discount' => 13,
                'image' => 'products/minimalist-double-loop-necklace.webp',
                'short' => 'Gold interlocking circles pendant with crystal accent.',
                'description' => 'Elegant minimalist necklace featuring two interlocking rings - one smooth gold, one adorned with sparkling crystals.',
                'stock' => 14,
                'sku' => 'N-001',
                'category' => 'Necklaces',
                'tags' => ['Gold', 'Crystal', 'Minimalist', 'Modern'],
            ],
            [
                'slug' => 'paw-print-infinity-ring',
                'name' => 'Paw Print Infinity Ring',
                'price' => 3500,
                'old_price' => 4200,
                'discount' => 17,
                'image' => 'products/paw-print-infinity-ring.webp',
                'short' => 'Sterling silver infinity ring with paw prints and sentiment.',
                'description' => 'Touching memorial ring featuring infinity symbol with two black paw prints. Inscribed "Always In My Heart" for pet lovers.',
                'stock' => 9,
                'sku' => 'R-003',
                'category' => 'Rings',
                'tags' => ['Silver', 'Infinity', 'Modern'],
            ],
            [
                'slug' => 'butterfly-wrap-around-ring',
                'name' => 'Butterfly Wrap Around Ring',
                'price' => 3800,
                'old_price' => 4500,
                'discount' => 16,
                'image' => 'products/butterfly-wrap-around-ring.webp',
                'short' => 'Crystal-studded butterfly ring that wraps elegantly.',
                'description' => 'Stunning wrap-style ring featuring two crystal butterflies embracing the finger. Sparkling pavé crystals throughout.',
                'stock' => 11,
                'sku' => 'R-004',
                'category' => 'Rings',
                'tags' => ['Silver', 'Crystal', 'Classic','Minimalist'],
            ],
            [
                'slug' => 'smiley-face-hoop-earrings',
                'name' => 'Smiley Face Hoop Earrings',
                'price' => 2600,
                'old_price' => 3100,
                'discount' => 16,
                'image' => 'products/smiley-face-hoop-earrings.webp',
                'short' => 'Cheerful white enamel smiley hoops in gold.',
                'description' => 'Spread joy with these adorable smiley face charm hoops. White enamel faces with gold-tone hardware.',
                'stock' => 16,
                'sku' => 'E-003',
                'category' => 'Earrings',
                'tags' => ['Gold', 'Modern'],
            ],
            [
                'slug' => 'rainbow-charm-bracelet',
                'name' => 'Rainbow Charm Bracelet',
                'price' => 4500,
                'old_price' => 5400,
                'discount' => 17,
                'image' => 'products/rainbow-charm-bracelet.webp',
                'short' => 'Colorful charm bracelet with rainbow beads and symbols.',
                'description' => 'Vibrant stainless steel bracelet loaded with rainbow-striped beads, crown, elephant, leaf, and rainbow charms. Adjustable fit.',
                'stock' => 7,
                'sku' => 'B-002',
                'category' => 'Bracelets',
                'tags' => ['Silver', 'Boho'],
            ],
            [
                'slug' => 'clover-black-enamel-bracelet',
                'name' => 'Clover Black Enamel Bracelet',
                'price' => 3900,
                'old_price' => 4600,
                'discount' => 15,
                'image' => 'products/clover-black-enamel-bracelet.webp',
                'short' => 'Five four-leaf clover stations in black and gold.',
                'description' => 'Sophisticated chain bracelet featuring five black enamel clover motifs bordered in gold. Adjustable length with extension chain.',
                'stock' => 13,
                'sku' => 'B-003',
                'category' => 'Bracelets',
                'tags' => ['Gold', 'Black' , 'Modern', 'Minimalist', 'Classic'],
            ],
            [
                'slug' => 'bff-cat-necklace-set',
                'name' => 'BFF Cat Necklace Set',
                'price' => 4800,
                'old_price' => 5600,
                'discount' => 14,
                'image' => 'products/bff-cat-necklace-set.webp',
                'short' => 'Matching best friend cat pendants in white and purple.',
                'description' => 'Adorable BFF necklace set featuring two kawaii cats holding hands. One white, one purple, with "BFF" charms.',
                'stock' => 6,
                'sku' => 'N-002',
                'category' => 'Necklaces',
                'tags' => ['Gold', 'Modern'],
            ],
            [
                'slug' => 'moonstone-crescent-ring',
                'name' => 'Moonstone Crescent Ring',
                'price' => 4100,
                'old_price' => 4900,
                'discount' => 16,
                'image' => 'products/moonstone-crescent-ring.webp',
                'short' => 'Open ring with aurora moonstone and crystal moon.',
                'description' => 'Mystical adjustable ring featuring iridescent aurora moonstone orb paired with a crystal-studded crescent moon. Stamped S925.',
                'stock' => 10,
                'sku' => 'R-005',
                'category' => 'Rings',
                'tags' => ['Silver', 'Diamond','Crystal', 'Celestial','Modern'],
            ],
            [
                'slug' => 'silver-bow-ring',
                'name' => 'Silver Bow Ring',
                'price' => 2800,
                'old_price' => 3300,
                'discount' => 15,
                'image' => 'products/silver-bow-ring.webp',
                'short' => 'Polished sterling silver ribbon bow ring.',
                'description' => 'Classic ribbon bow design in high-polish sterling silver. Timeless feminine charm perfect for any occasion.',
                'stock' => 17,
                'sku' => 'R-006',
                'category' => 'Rings',
                'tags' => ['Silver',  'Classic'],
            ],
            [
                'slug' => 'cat-silhouette-double-ring',
                'name' => 'Cat Silhouette Double Ring',
                'price' => 3300,
                'old_price' => 3900,
                'discount' => 15,
                'image' => 'products/cat-silhouette-double-ring.webp',
                'short' => 'Two-band ring with open cat outline and heart.',
                'description' => 'Unique double-band design featuring a sitting cat silhouette with heart-shaped tail. Delicate crystal accent collar. Stamped S925.',
                'stock' => 12,
                'sku' => 'R-007',
                'category' => 'Rings',
                'tags' => ['Silver', 'Cat', 'Crystal', 'Double Band','Modern'],
            ],
            [
                'slug' => 'cat-paw-open-ring',
                'name' => 'Cat Paw Open Ring',
                'price' => 2500,
                'old_price' => 3000,
                'discount' => 17,
                'image' => 'products/cat-paw-open-ring.webp',
                'short' => 'Adjustable silver ring with cat head and paw print.',
                'description' => 'Adorable open ring design with cat face on one end and detailed paw print on the other. Adjustable fit.',
                'stock' => 19,
                'sku' => 'R-008',
                'category' => 'Rings',
                'tags' => ['Silver', 'Cat', 'Modern'],
            ],
            [
                'slug' => 'paw-print-sentiment-bangle',
                'name' => 'Paw Print Sentiment Bangle',
                'price' => 3600,
                'old_price' => 4300,
                'discount' => 16,
                'image' => 'products/paw-print-sentiment-bangle.webp',
                'short' => 'Open bangle with heart message and paw print.',
                'description' => 'Touching memorial bangle engraved "When I Needed A Hand I Found Your Paw" with heart and paw charms. Sterling silver.',
                'stock' => 8,
                'sku' => 'BA-001',
                'category' => 'Bracelets',
                'tags' => ['Silver', 'Bangle','Modern'],
            ],
            [
                'slug' => 'delicate-bow-necklace',
                'name' => 'Delicate Bow Necklace',
                'price' => 3400,
                'old_price' => 4000,
                'discount' => 15,
                'image' => 'products/delicate-bow-necklace.webp',
                'short' => 'Minimalist gold bow pendant on fine chain.',
                'description' => 'Elegant wire-style bow pendant in gold tone. Simple, feminine, and perfect for layering or wearing alone.',
                'stock' => 15,
                'sku' => 'N-003',
                'category' => 'Necklaces',
                'tags' => ['Gold', 'Bow', 'Minimalist'],
            ],
            [
                'slug' => 'love-knot-cuff-bracelet',
                'name' => 'Love Knot Cuff Bracelet',
                'price' => 3800,
                'old_price' => 4500,
                'discount' => 16,
                'image' => 'products/love-knot-cuff-bracelet.webp',
                'short' => 'Open cuff with infinity knot center detail.',
                'description' => 'Modern open cuff bracelet featuring an elegant infinity love knot at the center. Polished gold tone with ball terminals.',
                'stock' => 11,
                'sku' => 'BA-002',
                'category' => 'Bracelets',
                'tags' => ['Gold', 'Minimalist', 'Love'],
            ],
            [
                'slug' => 'gold-charm-hoop-earrings',
                'name' => 'Gold Charm Hoop Earrings',
                'price' => 4500,
                'old_price' => 5200,
                'discount' => 13,
                'image' => 'products/gold-charm-hoop-earrings.png',
                'short' => 'Luxe hoops with hammered disc and black bead charms.',
                'description' => 'Statement hoop earrings featuring dangling charms: hammered gold disc, polished teardrop, and faceted black onyx beads on delicate chains.',
                'stock' => 8,
                'sku' => 'E-009',
                'category' => 'Earrings',
                'tags' => ['Gold', 'Modern', 'Black', 'Statement'],
            ],
            [
                'slug' => 'classic-pearl-drop-earrings',
                'name' => 'Classic Pearl Drop Earrings',
                'price' => 3800,
                'old_price' => 4400,
                'discount' => 14,
                'image' => 'products/classic-pearl-drop-earrings.png',
                'short' => 'Lustrous white pearls on elegant gold hooks.',
                'description' => 'Timeless pearl earrings featuring 10mm round freshwater pearls suspended from sleek gold French hooks. Perfect for any occasion.',
                'stock' => 15,
                'sku' => 'E-010',
                'category' => 'Earrings',
                'tags' => ['Gold', 'Pearl', 'Classic', 'Elegant', 'Drop'],
            ],
            [
                'slug' => 'turquoise-pearl-chandelier-earrings',
                'name' => 'Turquoise Pearl Chandelier Earrings',
                'price' => 4800,
                'old_price' => 5600,
                'discount' => 14,
                'image' => 'products/turquoise-pearl-chandelier-earrings.png',
                'short' => 'Bohemian hoops with turquoise and pearl cascades.',
                'description' => 'Stunning chandelier earrings featuring turquoise teardrops and creamy pearls dangling from gold hoop base. Perfect boho-chic statement piece.',
                'stock' => 7,
                'sku' => 'E-011',
                'category' => 'Earrings',
                'tags' => ['Gold', 'Boho', 'Turquoise', 'Pearl'],
            ],
            [
                'slug' => 'diamond-solitaire-engagement-ring',
                'name' => 'Diamond Solitaire Engagement Ring',
                'price' => 12500,
                'old_price' => 14200,
                'discount' => 12,
                'image' => 'products/diamond-solitaire-engagement-ring.png',
                'short' => 'Classic brilliant cut diamond in four-prong setting.',
                'description' => 'Timeless solitaire engagement ring featuring 1 carat round brilliant diamond in platinum four-prong setting with polished band.',
                'stock' => 4,
                'sku' => 'R-015',
                'category' => 'Rings',
                'tags' => ['Diamond', 'Classic', 'Solitaire', 'Engagement', 'Platinum'],
            ],
            [
                'slug' => 'single-pearl-wire-bangle',
                'name' => 'Single Pearl Wire Bangle',
                'price' => 4200,
                'old_price' => 4900,
                'discount' => 14,
                'image' => 'products/single-pearl-wire-bangle.png',
                'short' => 'Minimalist silver wire bangle with statement pearl.',
                'description' => 'Elegant open wire bangle featuring a single 14mm freshwater pearl accent. Adjustable clasp closure in polished sterling silver.',
                'stock' => 11,
                'sku' => 'BA-003',
                'category' => 'Bracelets',
                'tags' => ['Silver', 'Pearl', 'Minimalist', 'Modern', 'Bangle'],
            ],
            [
                'slug' => 'diamond-solitaire-pendant',
                'name' => 'Diamond Solitaire Pendant',
                'price' => 6800,
                'old_price' => 7900,
                'discount' => 14,
                'image' => 'products/diamond-solitaire-pendant.png',
                'short' => 'Single diamond in four-prong setting on delicate chain.',
                'description' => 'Classic diamond necklace with brilliant cut stone in white gold four-prong setting. Adjustable 16-18 inch chain included.',
                'stock' => 9,
                'sku' => 'N-009',
                'category' => 'Necklaces',
                'tags' => ['Diamond', 'Classic', 'Minimalist', 'Solitaire', 'White Gold'],
            ],
            [
                'slug' => 'turquoise-stone-boho-necklace',
                'name' => 'Turquoise Stone Boho Necklace',
                'price' => 3900,
                'old_price' => 4600,
                'discount' => 15,
                'image' => 'products/turquoise-stone-boho-necklace.png',
                'short' => 'Natural turquoise pendant on leather cord.',
                'description' => 'Bohemian-inspired necklace with raw turquoise stone wrapped in gold wire on adjustable brown leather cord.',
                'stock' => 9,
                'sku' => 'N-004',
                'category' => 'Necklaces',
                'tags' => ['Gold', 'Boho', 'Turquoise', 'Stone'],
            ],
            [
                'slug' => 'minimalist-bar-bracelet',
                'name' => 'Minimalist Bar Bracelet',
                'price' => 2900,
                'old_price' => 3400,
                'discount' => 15,
                'image' => 'products/minimalist-bar-bracelet.png',
                'short' => 'Sleek horizontal bar on delicate chain.',
                'description' => 'Modern minimalist bracelet featuring a simple gold bar accent on ultra-fine chain. Perfect for everyday wear.',
                'stock' => 22,
                'sku' => 'B-004',
                'category' => 'Bracelets',
                'tags' => ['Gold', 'Minimalist', 'Modern', 'Simple'],
            ],
            [
                'slug' => 'rose-gold-halo-ring',
                'name' => 'Rose Gold Halo Ring',
                'price' => 6800,
                'old_price' => 7900,
                'discount' => 14,
                'image' => 'products/rose-gold-halo-ring.png',
                'short' => 'Diamond halo surrounding center stone in rose gold.',
                'description' => 'Romantic rose gold ring with center diamond surrounded by sparkling halo. Feminine and contemporary design.',
                'stock' => 7,
                'sku' => 'R-010',
                'category' => 'Rings',
                'tags' => ['Rose Gold', 'Diamond', 'Halo', 'Modern', 'Romantic'],
            ],
        ];
    }

    // Show single product detail
    public function show($slug)
    {
        $products = $this->productData();
        $product = collect($products)->firstWhere('slug', $slug);

        if (!$product) {
            abort(404);
        }

        return view('jewellery', compact('product'));
    }

    // Show all products with optional search
    public function index(Request $request)
    {
        $products = $this->productData();

        // Convert array to collection for easier filtering
        $products = collect($products);

        // Apply filters dynamically
        if ($request->filled('query')) {
            $search = strtolower($request->query('query'));
            $products = $products->filter(function ($product) use ($search) {
                return str_contains(strtolower($product['name']), $search)
                    || str_contains(strtolower($product['short']), $search)
                    || str_contains(strtolower($product['description']), $search);
            });
        }

        if ($request->filled('category')) {
            $category = $request->query('category');
            $products = $products->where('category', $category);
        }

        if ($request->filled('material')) {
            $material = strtolower($request->query('material'));
            $products = $products->filter(function ($product) use ($material) {
                return collect($product['tags'])->contains(function ($tag) use ($material) {
                    return strtolower($tag) === $material;
                });
            });
        }

        if ($request->filled('style')) {
            $style = strtolower($request->query('style'));
            $products = $products->filter(function ($product) use ($style) {
                return collect($product['tags'])->contains(function ($tag) use ($style) {
                    return strtolower($tag) === $style;
                });
            });
        }
        return view('products', ['products' => $products]);
    }


}
