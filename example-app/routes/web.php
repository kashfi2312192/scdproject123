<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', [PageController::class, 'home']);


Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('/homepage', function () {
    return view('homepage');
})->name('homepage');

Route::get('/products', [ProductController::class, 'index'])->name('products');

// Product details page
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');


Route::get('/contactus', function () {
    return view('contactus');
})->name('contactus');

Route::get('/jewellery', function () {
    return view('jewellery');
})->name('jewellery');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/checkout', function () {
    $cart = session('cart', []);
    $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
    return view('checkout', compact('cart','total'));
})->name('checkout');

Route::post('/checkout', function () {
    session()->forget('cart');
    return redirect()->route('thankyou')->with('success', 'Order placed successfully!');
})->name('checkout.process');


Route::get('/thank-you', function () {
    return view('thankyou');
})->name('thankyou');


Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');



