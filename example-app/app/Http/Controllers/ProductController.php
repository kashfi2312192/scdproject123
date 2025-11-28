<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $productsQuery = Product::query()
            ->when($request->filled('query'), function ($queryBuilder) use ($request) {
                $search = $request->string('query');

                $queryBuilder->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', '%' . $search . '%')
                        ->orWhere('short', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->when($request->filled('category'), function ($queryBuilder) use ($request) {
                $queryBuilder->where('category', $request->string('category'));
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

        return view('products', compact('products'));
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
