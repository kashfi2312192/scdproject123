@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-dark text-white px-3 py-2 mb-3">Welcome Back</span>
                <h1 class="fw-bold display-4 mb-3">Dashboard</h1>
                <p class="lead text-muted">Welcome back, {{ auth()->user()->name }}!</p>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary bg-opacity-10 rounded p-3">
                                        <i class="fas fa-shopping-bag fa-2x text-primary"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-muted mb-1 small fw-semibold">Total Orders</h6>
                                    <h2 class="mb-0 fw-bold">{{ $totalOrders }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-warning bg-opacity-10 rounded p-3">
                                        <i class="fas fa-clock fa-2x text-warning"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-muted mb-1 small fw-semibold">Pending Orders</h6>
                                    <h2 class="mb-0 fw-bold">{{ $pendingOrders }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-success bg-opacity-10 rounded p-3">
                                        <i class="fas fa-check-circle fa-2x text-success"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-muted mb-1 small fw-semibold">Completed Orders</h6>
                                    <h2 class="mb-0 fw-bold">{{ $totalOrders - $pendingOrders }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card border-0 shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-shopping-bag me-2"></i>Recent Orders</h5>
                </div>
                <div class="card-body p-4">
                    @if($recentOrders->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-bag fa-4x text-muted mb-3"></i>
                            <h4 class="fw-bold mb-2">No orders yet</h4>
                            <p class="text-muted mb-4">You haven't placed any orders yet.</p>
                            <a href="{{ route('products') }}" class="btn btn-dark btn-lg rounded-pill px-5">
                                <i class="fas fa-shopping-cart me-2"></i>Start Shopping
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Order Number</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th class="text-end pe-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                        <tr>
                                            <td class="fw-semibold ps-3">{{ $order->order_number }}</td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
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
                                            <td class="text-end pe-3">
                                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                                    <i class="fas fa-eye me-1"></i>View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ route('orders.index') }}" class="btn btn-outline-dark rounded-pill px-4">
                                View All Orders <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Contact Replies -->
            @if($contactReplies->isNotEmpty())
            <div class="card border-0 shadow mt-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-envelope me-2"></i>Admin Replies to Your Questions</h5>
                </div>
                <div class="card-body p-4">
                    @foreach($contactReplies as $contact)
                        <div class="border rounded p-4 mb-3 bg-light {{ $loop->first ? 'border-primary border-2' : '' }}">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h6 class="mb-1 fw-bold">{{ $contact->name }}</h6>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>Question submitted: {{ $contact->created_at->format('M d, Y') }}
                                    </small>
                                </div>
                                <small class="text-muted">
                                    <i class="fas fa-reply me-1"></i>Replied: {{ $contact->replied_at->format('M d, Y') }}
                                </small>
                            </div>
                            <div class="mb-3 p-3 bg-white rounded">
                                <strong class="text-muted small d-block mb-2">
                                    <i class="fas fa-question-circle me-1"></i>Your Question:
                                </strong>
                                <p class="mb-0">{{ $contact->message }}</p>
                            </div>
                            @if($contact->product_url)
                            <div class="mb-3">
                                <a href="{{ $contact->product_url }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-external-link-alt me-1"></i>View Product
                                </a>
                            </div>
                            @endif
                            <div class="alert alert-success rounded mb-0">
                                <strong class="d-block mb-2">
                                    <i class="fas fa-reply me-1"></i>Admin Reply:
                                </strong>
                                {{ $contact->reply }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>
@endsection
