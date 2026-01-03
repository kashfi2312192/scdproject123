@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')
    <section class="py-5 bg-light" style="margin-top: 5rem;">
        <div class="container">
            <div class="mb-4">
                <h1 class="fw-bold mb-1">Dashboard</h1>
                <p class="text-muted mb-0">Welcome back, {{ auth()->user()->name }}!</p>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-shopping-bag fa-2x text-primary"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-muted mb-0">Total Orders</h6>
                                    <h3 class="mb-0 fw-bold">{{ $totalOrders }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-clock fa-2x text-warning"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-muted mb-0">Pending Orders</h6>
                                    <h3 class="mb-0 fw-bold">{{ $pendingOrders }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle fa-2x text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-muted mb-0">Completed Orders</h6>
                                    <h3 class="mb-0 fw-bold">{{ $totalOrders - $pendingOrders }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Recent Orders</h5>
                </div>
                <div class="card-body">
                    @if($recentOrders->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-4">You haven't placed any orders yet.</p>
                            <a href="{{ route('products') }}" class="btn btn-dark rounded-pill">Start Shopping</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Order Number</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                        <tr>
                                            <td class="fw-semibold">{{ $order->order_number }}</td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
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
                                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-dark">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3 text-center">
                            <a href="{{ route('orders.index') }}" class="btn btn-outline-dark">View All Orders</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Contact Replies -->
            @if($contactReplies->isNotEmpty())
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Admin Replies to Your Questions</h5>
                </div>
                <div class="card-body">
                    @foreach($contactReplies as $contact)
                        <div class="border rounded p-3 mb-3 {{ $loop->first ? 'border-primary' : '' }}">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-1 fw-bold">{{ $contact->name }}</h6>
                                    <small class="text-muted">Question submitted: {{ $contact->created_at->format('M d, Y') }}</small>
                                </div>
                                <small class="text-muted">Replied: {{ $contact->replied_at->format('M d, Y') }}</small>
                            </div>
                            <div class="mb-2">
                                <strong class="text-muted small">Your Question:</strong>
                                <p class="mb-0 small">{{ $contact->message }}</p>
                            </div>
                            @if($contact->product_url)
                            <div class="mb-2">
                                <a href="{{ $contact->product_url }}" target="_blank" class="btn btn-sm btn-outline-primary">View Product →</a>
                            </div>
                            @endif
                            <div class="alert alert-success mb-0">
                                <strong>Admin Reply:</strong><br>
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
