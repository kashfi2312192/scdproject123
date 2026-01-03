@extends('layouts.layout')

@section('title', 'My Orders')

@section('content')
    <section class="py-5 bg-light" style="margin-top: 5rem;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fw-bold mb-1">My Orders</h1>
                    <p class="text-muted mb-0">View your order history and track your purchases.</p>
                </div>
                <a href="{{ route('products') }}" class="btn btn-dark rounded-pill">Continue Shopping</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($orders->isEmpty())
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                        <h4 class="fw-semibold mb-2">No orders yet</h4>
                        <p class="text-muted mb-4">Start shopping to see your orders here!</p>
                        <a href="{{ route('products') }}" class="btn btn-dark rounded-pill">Browse Products</a>
                    </div>
                </div>
            @else
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Order Number</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="fw-semibold">{{ $order->order_number }}</td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <small class="text-muted">{{ count($order->items) }} item(s)</small>
                                            </td>
                                            <td class="fw-bold">PKR {{ number_format($order->total, 2) }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if($order->status == 'completed') bg-success
                                                    @elseif($order->status == 'processing') bg-primary
                                                    @elseif($order->status == 'cancelled') bg-danger
                                                    @else bg-warning
                                                    @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-dark">View Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $orders->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

