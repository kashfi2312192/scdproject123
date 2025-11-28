@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Orders</h2>
            <p class="text-muted mb-0">View and manage customer orders.</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($orders->isEmpty())
                <p class="mb-0 text-muted">No orders found.</p>
            @else
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="fw-semibold">{{ $order->order_number }}</td>
                                    <td>
                                        <div>{{ $order->name }}</div>
                                        <small class="text-muted">{{ $order->email }}</small>
                                    </td>
                                    <td>PKR {{ number_format($order->total, 2) }}</td>
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
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div>
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection

