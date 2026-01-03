<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $productsQuery = Product::query()
            ->with('category')
            ->when($request->filled('query'), function ($queryBuilder) use ($request) {
                $search = $request->string('query');

                $queryBuilder->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', '%' . $search . '%')
                        ->orWhere('short', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->when($request->filled('category'), function ($queryBuilder) use ($request) {
                $categoryId = $request->integer('category');
                if ($categoryId > 0) {
                    $queryBuilder->where('category_id', $categoryId);
                }
            })
            ->when($request->filled('material'), function ($queryBuilder) use ($request) {
                $queryBuilder->whereJsonContains('tags', $request->string('material'));
            })
            ->when($request->filled('style'), function ($queryBuilder) use ($request) {
                $queryBuilder->whereJsonContains('tags', $request->string('style'));
            });

        $products = $productsQuery
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = \App\Models\Category::orderBy('name')->get();

        return view('products', compact('products', 'categories'));
    }

    public function search(Request $request)
    {
        $query = trim($request->get('q', ''));
        $category = trim($request->get('category', ''));

        // Return empty if no query
        if (empty($query)) {
            return response()->json([]);
        }

        $products = Product::query()
            ->with('category')
            ->when($query, function ($queryBuilder) use ($query) {
                // Only search by name - case-insensitive matching
                $searchTerm = '%' . strtolower($query) . '%';
                $queryBuilder->whereRaw('LOWER(name) LIKE ?', [$searchTerm]);
            })
            ->when($category, function ($queryBuilder) use ($category) {
                // Filter by category ID
                $categoryId = (int) $category;
                if ($categoryId > 0) {
                    $queryBuilder->where('category_id', $categoryId);
                }
            })
            ->latest()
            ->limit(10)
            ->get();

        return response()->json($products->map(function ($product) {
            $categoryName = 'Uncategorized';
            if ($product->relationLoaded('category') && $product->getRelation('category')) {
                $categoryName = $product->getRelation('category')->name;
            } elseif ($product->category_id) {
                $category = $product->category;
                if (is_object($category)) {
                    $categoryName = $category->name;
                }
            } elseif (!empty($product->getAttribute('category')) && is_string($product->getAttribute('category'))) {
                $categoryName = $product->getAttribute('category');
            }
            
            return [
                'id' => $product->id,
                'name' => $product->name,
                'category' => $categoryName,
                'price' => $product->price,
                'image_url' => $product->image_url,
                'url' => route('products.show', $product),
            ];
        }));
    }

    public function show(Product $product)
    {
        $product->load(['reviews' => function ($query) {
            $query->latest();
        }]);

        return view('jewellery', [
            'product' => $product,
            'averageRating' => round($product->reviews->avg('rating') ?? 0, 1),
            'reviewsCount' => $product->reviews->count(),
        ]);
    }
}
