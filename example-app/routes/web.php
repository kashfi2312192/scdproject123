<?php


use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\ContactInfoController as AdminContactInfoController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PolicyController as AdminPolicyController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('homepage');
Route::get('/homepage', fn () => redirect()->route('homepage'));

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/search/ajax', [ProductController::class, 'search'])->name('products.search.ajax');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products/{product}/reviews', [ProductReviewController::class, 'store'])->name('products.reviews.store');

Route::get('/contactus', [ContactController::class, 'index'])->name('contactus');
Route::post('/contactus', [ContactController::class, 'store'])->name('contactus.store');
Route::post('/products/{product}/question', [ContactController::class, 'storeProductQuestion'])->name('products.question.store');
Route::get('/policies', [PolicyController::class, 'index'])->name('policies.index');
Route::get('/policy/{slug}', [PolicyController::class, 'show'])->name('policy.show');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', function () {
        $cart = collect(session()->get('cart', []))
            ->map(function ($item) {
                if (!isset($item['image_url'])) {
                    $product = new \App\Models\Product(['image' => $item['image'] ?? null]);
                    $item['image_url'] = $product->image_url;
                }
                return $item;
            })
            ->toArray();
        
        session()->put('cart', $cart);
        $total = array_sum(array_map(fn ($item) => $item['price'] * $item['quantity'], $cart));

        return view('checkout', compact('cart', 'total'));
    })->name('checkout');

    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.process');
});

Route::view('/thank-you', 'thankyou')->name('thankyou');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

// Admin routes - require authentication and admin role
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class)->except('show');
    Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
    Route::post('contacts/{contact}/reply', [AdminContactController::class, 'reply'])->name('contacts.reply');
    Route::resource('policies', AdminPolicyController::class);
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);
    Route::post('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::resource('contact-infos', AdminContactInfoController::class)->only(['index', 'edit', 'update']);
});

require __DIR__ . '/auth.php';



