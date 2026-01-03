@extends('admin.layouts.app')

@section('title', 'Order Details')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
        <div class="mb-3 mb-md-0">
            <span class="badge bg-dark text-white px-3 py-2 mb-3">Order Details</span>
            <h1 class="fw-bold display-5 mb-2">Order #{{ $order->order_number }}</h1>
            <p class="lead text-muted">View order details and update status.</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-dark rounded-pill px-4">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-shopping-bag me-2"></i>Order Items</h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Product</th>
                                    <th>Quantity</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end pe-3">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="d-flex align-items-center">
                                                @if(isset($item['image_url']))
                                                    <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="rounded shadow-sm me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                                @elseif(isset($item['image']))
                                                    <img src="{{ asset('img/' . $item['image']) }}" alt="{{ $item['name'] }}" class="rounded shadow-sm me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                                @endif
                                                <div>
                                                    <strong>{{ $item['name'] }}</strong>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary bg-opacity-10 text-dark px-3 py-2 rounded-pill">
                                                {{ $item['quantity'] }}
                                            </span>
                                        </td>
                                        <td class="text-end">PKR {{ number_format($item['price'], 2) }}</td>
                                        <td class="text-end fw-bold pe-3">PKR {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th colspan="3" class="text-end ps-3">Total:</th>
                                    <th class="text-end text-primary pe-3">PKR {{ number_format($order->total, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-user me-2"></i>Customer Information</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <strong class="d-block mb-1"><i class="fas fa-user me-2 text-primary"></i>Name:</strong>
                        {{ $order->name }}
                    </div>
                    <div class="mb-3">
                        <strong class="d-block mb-1"><i class="fas fa-envelope me-2 text-primary"></i>Email:</strong>
                        <a href="mailto:{{ $order->email }}" class="text-decoration-none">{{ $order->email }}</a>
                    </div>
                    <div class="mb-3">
                        <strong class="d-block mb-1"><i class="fas fa-phone me-2 text-primary"></i>Phone:</strong>
                        {{ $order->phone }}
                    </div>
                    <div class="mb-3">
                        <strong class="d-block mb-1"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Address:</strong>
                        {{ $order->address }}
                    </div>
                    <div class="mb-0">
                        <strong class="d-block mb-1"><i class="fas fa-credit-card me-2 text-primary"></i>Payment Method:</strong>
                        <span class="badge bg-primary rounded-pill px-3 py-2">{{ strtoupper($order->payment_method) === 'COD' ? 'Cash on Delivery' : 'Card Payment' }}</span>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-edit me-2"></i>Update Status</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-bold mb-2">Order Status</label>
                            <select name="status" class="form-select form-select-lg rounded-pill" required>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark btn-lg w-100 rounded-pill py-3 shadow">
                            <i class="fas fa-save me-2"></i>Update Status
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

