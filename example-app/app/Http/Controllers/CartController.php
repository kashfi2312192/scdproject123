<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //  Show the cart page
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart', compact('cart', 'total'));
    }

    //  Add to Cart
    // Add product to cart
    public function add(Request $request)
    {
        // Expecting the request to send 'slug' of the product
        $slug = $request->input('slug');

        // Get product details from ProductController
        $products = (new \App\Http\Controllers\ProductController)->productData();
        $product = collect($products)->firstWhere('slug', $slug);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found!'
            ], 404);
        }

        $quantity = (int) $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        // Use slug as key to prevent duplicates
        if (isset($cart[$slug])) {
            $cart[$slug]['quantity'] += $quantity;
        } else {
            $cart[$slug] = [
                'slug' => $product['slug'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => "✅ Added $quantity item(s) to your cart!"
        ]);
    }

    // ✅ Remove single item
    public function remove(Request $request)
    {
        $slug = $request->input('slug');
        $cart = session()->get('cart', []);

        if (isset($cart[$slug])) {
            unset($cart[$slug]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function update(Request $request)
    {
        $slug = $request->input('slug');
        $quantity = (int) $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$slug])) {
            $cart[$slug]['quantity'] = max(1, $quantity); // prevent negative
            session()->put('cart', $cart);
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return response()->json([
            'success' => true,
            'quantity' => $cart[$slug]['quantity'],
            'itemTotal' => $cart[$slug]['price'] * $cart[$slug]['quantity'],
            'cartTotal' => $total,
        ]);
    }

    // Clear the entire cart
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');
    }
}
