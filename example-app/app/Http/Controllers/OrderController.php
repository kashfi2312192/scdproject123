<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $cart = session('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'payment_method' => ['required', 'string', 'in:cod,card'],
        ]);

        $total = array_sum(array_map(fn ($item) => $item['price'] * $item['quantity'], $cart));

        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'payment_method' => $validated['payment_method'],
            'total' => $total,
            'items' => $cart,
            'status' => 'pending',
        ]);

        session()->forget('cart');

        return redirect()
            ->route('thankyou')
            ->with('success', 'Order placed successfully! Your order number is: ' . $order->order_number);
    }
}
