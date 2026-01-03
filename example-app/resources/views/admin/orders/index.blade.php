@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
    <div class="mb-5">
        <span class="badge bg-dark text-white px-3 py-2 mb-3">Order Management</span>
        <h1 class="fw-bold display-5 mb-2">Orders</h1>
        <p class="lead text-muted">View and manage customer orders.</p>
    </div>

    <div class="card border-0 shadow">
        <div class="card-body p-0">
            @if($orders->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                    <h4 class="fw-bold mb-2">No orders found</h4>
                    <p class="text-muted">Orders will appear here when customers make purchases.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4">Order Number</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="fw-semibold ps-4">{{ $order->order_number }}</td>
                                    <td>
                                        <div class="fw-semibold">{{ $order->name }}</div>
                                        <small class="text-muted">{{ $order->email }}</small>
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
                                    <td><small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small></td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-4">
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection

