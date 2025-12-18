<?php

use App\Models\ContactInfo;
use App\Models\Policy;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/products', function (Request $request) {
    $products = Product::query()
        ->with('reviews')
        ->when($request->filled('query'), function ($queryBuilder) use ($request) {
            $search = $request->string('query');

            $queryBuilder->where(function ($inner) use ($search) {
                $inner->where('name', 'like', '%' . $search . '%')
                    ->orWhere('short', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        })
        ->latest()
        ->paginate(12)
        ->withQueryString();

    return response()->json($products);
});

Route::get('/products/{product}', function (Product $product) {
    $product->load(['reviews' => function ($query) {
        $query->latest();
    }]);

    return response()->json([
        'data' => $product,
        'average_rating' => round($product->reviews->avg('rating') ?? 0, 1),
        'reviews_count' => $product->reviews->count(),
    ]);
});

Route::get('/policies', function () {
    return response()->json(Policy::all());
});

Route::get('/contact-info', function () {
    return response()->json(ContactInfo::all());
});


