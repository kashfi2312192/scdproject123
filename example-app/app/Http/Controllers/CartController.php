<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = collect(session()->get('cart', []))
            ->map(function ($item) {
                $item['image_url'] = $item['image_url'] ?? $this->resolveImageUrl($item['image'] ?? null);

                return $item;
            })
            ->toArray();

        session()->put('cart', $cart);

        return view('cart', [
            'cart' => $cart,
            'total' => $this->calculateTotal($cart),
        ]);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $quantity = (int) ($validated['quantity'] ?? 1);

        $cart = session()->get('cart', []);
        $key = (string) $product->id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $quantity;
        } else {
            $cart[$key] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'image_url' => $product->image_url,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        $message = "✅ Added {$quantity} item(s) to your cart!";

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'cartTotal' => $this->calculateTotal($cart),
            ]);
        }

        return redirect()->route('cart.index')->with('success', $message);
    }

    public function remove(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer'],
        ]);

        $cart = session()->get('cart', []);
        $key = (string) $validated['product_id'];

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = session()->get('cart', []);
        $key = (string) $validated['product_id'];

        if (!isset($cart[$key])) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in cart.',
            ], 404);
        }

        $cart[$key]['quantity'] = $validated['quantity'];
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'quantity' => $cart[$key]['quantity'],
            'itemTotal' => $cart[$key]['price'] * $cart[$key]['quantity'],
            'cartTotal' => $this->calculateTotal($cart),
        ]);
    }

    public function clear(): RedirectResponse
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');
    }

    private function calculateTotal(array $cart): float
    {
        return collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
    }

    private function resolveImageUrl(?string $path): string
    {
        $product = new Product(['image' => $path]);

        return $product->image_url;
    }
}
