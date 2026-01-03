@extends('layouts.layout')

@section('title', 'Order Details')

@section('content')
    <section class="py-5 bg-light" style="margin-top: 5rem;">
        <div class="container">
            <div class="mb-4">
                <a href="{{ route('orders.index') }}" class="text-decoration-none">
                    <i class="fas fa-arrow-left me-2"></i>Back to Orders
                </a>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Order #{{ $order->order_number }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h6 class="fw-semibold mb-3">Order Items</h6>
                                @foreach($order->items as $item)
                                    <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                                        <img src="{{ $item['image_url'] ?? asset('img/logo.webp') }}" 
                                             alt="{{ $item['name'] }}" 
                                             style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $item['name'] }}</h6>
                                            <small class="text-muted">Quantity: {{ $item['quantity'] }}</small>
                                        </div>
                                        <div class="text-end">
                                            <div class="fw-bold">PKR {{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                                            <small class="text-muted">PKR {{ number_format($item['price'], 2) }} each</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <h5 class="mb-0">Total</h5>
                                <h4 class="mb-0 fw-bold">PKR {{ number_format($order->total, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-dark text-white">
                            <h6 class="mb-0">Order Status</h6>
                        </div>
                        <div class="card-body">
                            <span class="badge 
                                @if($order->status == 'completed') bg-success
                                @elseif($order->status == 'processing') bg-primary
                                @elseif($order->status == 'cancelled') bg-danger
                                @else bg-warning
                                @endif fs-6 px-3 py-2">
                                {{ ucfirst($order->status) }}
                            </span>
                            <p class="text-muted small mt-3 mb-0">
                                Placed on {{ $order->created_at->format('F d, Y \a\t g:i A') }}
                            </p>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h6 class="mb-0">Shipping Information</h6>
                        </div>
                        <div class="card-body">
                            <p class="mb-2"><strong>Name:</strong><br>{{ $order->name }}</p>
                            <p class="mb-2"><strong>Email:</strong><br>{{ $order->email }}</p>
                            <p class="mb-2"><strong>Phone:</strong><br>{{ $order->phone }}</p>
                            <p class="mb-0"><strong>Address:</strong><br>{{ $order->address }}</p>
                        </div>
                    </div>

                    <div class="card shadow-sm mt-4">
                        <div class="card-header bg-dark text-white">
                            <h6 class="mb-0">Payment Information</h6>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">
                                <strong>Payment Method:</strong><br>
                                {{ strtoupper($order->payment_method) === 'COD' ? 'Cash on Delivery' : 'Card Payment' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

