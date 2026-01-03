<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Order::query();

        // If user is not admin, only show their orders
        if (!$request->user()->is_admin) {
            $query->where('user_id', $request->user()->id);
        }

        $orders = $query->latest()->paginate($request->integer('per_page', 10));

        return response()->json($orders);
    }

    public function show(Request $request, Order $order): JsonResponse
    {
        // If user is not admin, ensure they can only see their own orders
        if (!$request->user()->is_admin && $order->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($order);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'payment_method' => ['required', 'string', 'in:cod,card'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.name' => ['required', 'string'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
        ]);

        $total = array_sum(array_map(fn ($item) => $item['price'] * $item['quantity'], $validated['items']));

        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'user_id' => $request->user()->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'payment_method' => $validated['payment_method'],
            'total' => $total,
            'items' => $validated['items'],
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Order created successfully',
            'data' => $order,
        ], 201);
    }

    public function update(Request $request, Order $order): JsonResponse
    {
        // Only admins can update orders
        if (!$request->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'status' => ['required', 'string', 'in:pending,processing,completed,cancelled'],
        ]);

        $order->update($validated);

        return response()->json([
            'message' => 'Order updated successfully',
            'data' => $order,
        ]);
    }

    public function destroy(Request $request, Order $order): JsonResponse
    {
        // Only admins can delete orders
        if (!$request->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $order->delete();

        return response()->json([
            'message' => 'Order deleted successfully',
        ]);
    }
}

