<?php


use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('homepage');
Route::get('/homepage', fn () => redirect()->route('homepage'));

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products/{product}/reviews', [ProductReviewController::class, 'store'])->name('products.reviews.store');

Route::view('/contactus', 'contactus')->name('contactus');

Route::get('/checkout', function () {
    $cart = session('cart', []);
    $total = array_sum(array_map(fn ($item) => $item['price'] * $item['quantity'], $cart));

    return view('checkout', compact('cart', 'total'));
})->name('checkout');

Route::post('/checkout', function () {
    session()->forget('cart');

    return redirect()->route('thankyou')->with('success', 'Order placed successfully!');
})->name('checkout.process');

Route::view('/thank-you', 'thankyou')->name('thankyou');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('authenticate');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', AdminProductController::class)->except('show');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

require __DIR__ . '/auth.php';



