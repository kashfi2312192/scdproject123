@extends('admin.layouts.app')

@section('title', 'Order Details')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Order #{{ $order->order_number }}</h2>
            <p class="text-muted mb-0">View order details and update status.</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Back to List</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Order Items</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if(isset($item['image']))
                                                <img src="{{ asset('img/' . $item['image']) }}" alt="{{ $item['name'] }}" class="rounded me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                            @endif
                                            <div>
                                                <strong>{{ $item['name'] }}</strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td class="text-end">PKR {{ number_format($item['price'], 2) }}</td>
                                    <td class="text-end">PKR {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total:</th>
                                <th class="text-end">PKR {{ number_format($order->total, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Customer Information</h5>
                    <div class="mb-3">
                        <strong>Name:</strong><br>
                        {{ $order->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong><br>
                        <a href="mailto:{{ $order->email }}">{{ $order->email }}</a>
                    </div>
                    <div class="mb-3">
                        <strong>Phone:</strong><br>
                        {{ $order->phone }}
                    </div>
                    <div class="mb-3">
                        <strong>Address:</strong><br>
                        {{ $order->address }}
                    </div>
                    <div class="mb-3">
                        <strong>Payment Method:</strong><br>
                        <span class="badge bg-secondary">{{ strtoupper($order->payment_method) }}</span>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Update Status</h5>
                    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <select name="status" class="form-select" required>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

