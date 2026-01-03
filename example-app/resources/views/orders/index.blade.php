@extends('layouts.layout')

@section('title', 'My Orders')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
                <div class="text-center text-md-start mb-3 mb-md-0">
                    <span class="badge bg-dark text-white px-3 py-2 mb-3">Order History</span>
                    <h1 class="fw-bold display-4 mb-2">My Orders</h1>
                    <p class="lead text-muted">View your order history and track your purchases.</p>
                </div>
                <a href="{{ route('products') }}" class="btn btn-dark btn-lg rounded-pill px-5">
                    <i class="fas fa-shopping-cart me-2"></i>Continue Shopping
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($orders->isEmpty())
                <div class="card border-0 shadow">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-shopping-bag fa-4x text-muted mb-3"></i>
                        <h4 class="fw-bold mb-2">No orders yet</h4>
                        <p class="text-muted mb-4">Start shopping to see your orders here!</p>
                        <a href="{{ route('products') }}" class="btn btn-dark btn-lg rounded-pill px-5">
                            <i class="fas fa-shopping-cart me-2"></i>Browse Products
                        </a>
                    </div>
                </div>
            @else
                <div class="card border-0 shadow">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="ps-4">Order Number</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="fw-semibold ps-4">{{ $order->order_number }}</td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <span class="badge bg-secondary bg-opacity-10 text-dark px-3 py-2 rounded-pill">
                                                    <i class="fas fa-box me-1"></i>{{ count($order->items) }} item(s)
                                                </span>
                                            </td>
                                            <td class="fw-bold">PKR {{ number_format($order->total, 2) }}</td>
                                            <td>
                                                <span class="badge rounded-pill px-3 py-2
                                                    @if($order->status == 'completed') bg-success
                                                    @elseif($order->status == 'processing') bg-primary
                                                    @elseif($order->status == 'cancelled') bg-danger
                                                    @else bg-warning
                                                    @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                                    <i class="fas fa-eye me-1"></i>View Details
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 p-4">
                            {{ $orders->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

