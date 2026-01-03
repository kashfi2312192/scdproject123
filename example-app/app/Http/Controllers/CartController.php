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
        $cart = session()->get('cart', []);
        $removedItems = [];
        $removedMessages = [];

        // Check each item and remove if out of stock or deleted
        foreach ($cart as $key => $item) {
            $product = Product::find($item['id']);
            
            if (!$product) {
                // Product was deleted
                $removedItems[] = $item['name'] ?? 'Unknown Product';
                unset($cart[$key]);
                $removedMessages[] = "Product '{$item['name']}' has been removed from the store and was removed from your cart.";
            } elseif (!$product->is_in_stock) {
                // Product is out of stock
                $removedItems[] = $item['name'];
                unset($cart[$key]);
                $removedMessages[] = "Product '{$item['name']}' is now out of stock and was removed from your cart.";
            } else {
                // Product exists and is in stock - update image URL
                $cart[$key]['image_url'] = $item['image_url'] ?? $this->resolveImageUrl($item['image'] ?? null);
                $cart[$key]['is_in_stock'] = $product->is_in_stock;
                $cart[$key]['product_name'] = $product->name;
            }
        }

        // Save updated cart
        session()->put('cart', $cart);

        // Prepare message if items were removed
        $removalMessage = null;
        if (!empty($removedItems)) {
            $removalMessage = "⚠️ Some items were removed from your cart:\n" . implode("\n", $removedMessages);
        }

        return view('cart', [
            'cart' => $cart,
            'total' => $this->calculateTotal($cart),
            'removalMessage' => $removalMessage,
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

        // Check if product is in stock
        if (!$product->is_in_stock) {
            $message = "❌ This product is currently out of stock and cannot be added to cart.";

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $message,
                ], 400);
            }

            return redirect()->back()->with('error', $message);
        }

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
                'is_in_stock' => $product->is_in_stock,
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

        // Check if product is still in stock
        $product = Product::find($validated['product_id']);
        if ($product && !$product->is_in_stock) {
            return response()->json([
                'success' => false,
                'message' => 'This product is out of stock. Quantity cannot be updated.',
            ], 400);
        }

        $cart[$key]['quantity'] = $validated['quantity'];
        if ($product) {
            $cart[$key]['is_in_stock'] = $product->is_in_stock;
        }
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
