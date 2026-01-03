@extends('layouts.layout')

@section('title', 'Your Cart - Emilliä Jewellery')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-dark text-white px-3 py-2 mb-3">Shopping Cart</span>
                <h2 class="fw-bold display-4 mb-3">Your Shopping Cart</h2>
                <p class="lead text-muted">Review your items before checkout</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success text-center auto-dismiss" data-dismiss-time="8000">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger text-center auto-dismiss" data-dismiss-time="8000">
                    {{ session('error') }}
                </div>
            @endif

            @if(isset($removalMessage) && $removalMessage)
                <div class="alert alert-warning auto-dismiss" data-dismiss-time="8000">
                    <strong>⚠️ Cart Updated:</strong>
                    <pre class="mb-0" style="white-space: pre-wrap;">{{ $removalMessage }}</pre>
                </div>
            @endif

            @if(empty($cart))
                <div class="text-center py-5">
                    <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                    <h4 class="fw-bold mb-2">Your cart is empty</h4>
                    <p class="text-muted mb-4">Start adding items to your cart!</p>
                    <a href="{{ url('/products') }}" class="btn btn-dark btn-lg rounded-pill px-5">
                        <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle bg-white shadow rounded overflow-hidden">
                        <thead class="table-dark">
                        <tr>
                            <th scope="col" class="ps-4">Product</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col" class="text-center pe-4">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                @foreach($cart as $item)
                            <tr class="{{ !($item['is_in_stock'] ?? true) ? 'table-warning' : '' }}">
                                <td class="text-center ps-4">
                            <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="img-fluid rounded shadow-sm" style="width: 90px; height: 90px; object-fit: cover;">
                                </td>
                                <td class="fw-semibold">
                                    {{ $item['name'] }}
                                    @if(!($item['is_in_stock'] ?? true))
                                        <br><small class="text-danger fw-bold">⚠️ Out of Stock</small>
                                    @endif
                                </td>
                                <td>PKR {{ number_format($item['price'], 2) }}</td>
                                <td>
                                    @if(!($item['is_in_stock'] ?? true))
                                        <div class="text-danger small">Cannot update quantity</div>
                                    @else
                                        <div class="d-flex align-items-center justify-content-left">
                                    <button class="btn btn-sm btn-outline-dark me-2 qty-btn" data-id="{{ $item['id'] }}" data-action="decrease">-</button>
                                    <input type="text" value="{{ $item['quantity'] }}" class="form-control text-center qty-input" style="width: 50px;" data-id="{{ $item['id'] }}">
                                    <button class="btn btn-sm btn-outline-dark ms-2 qty-btn" data-id="{{ $item['id'] }}" data-action="increase">+</button>
                                        </div>
                                    @endif
                                </td>

                                <td class="fw-bold">PKR {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td class="text-center">
                                    <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                                        @csrf
                                <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bg-white shadow rounded p-4 mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fw-bold mb-0">Total Amount:</h4>
                        <h3 class="fw-bold text-primary mb-0">PKR {{ number_format($total, 2) }}</h3>
                    </div>
                </div>

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-4">
                    <a href="{{ url('/products') }}" class="btn btn-outline-dark btn-lg rounded-pill px-5">
                        <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                    </a>

                    <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-lg rounded-pill px-5" onclick="return confirm('Are you sure you want to clear your cart?')">
                            <i class="fas fa-trash me-2"></i>Clear Cart
                        </button>
                    </form>

                    @php
                        $hasOutOfStock = collect($cart)->contains(function($item) {
                            return !($item['is_in_stock'] ?? true);
                        });
                    @endphp
                    @if($hasOutOfStock)
                        <div class="alert alert-warning rounded mb-3 w-100">
                            <strong><i class="fas fa-exclamation-triangle me-2"></i>Warning:</strong> Some items in your cart are out of stock. Please remove them before proceeding to checkout.
                        </div>
                    @endif
                    <a href="{{ route('checkout') }}" class="btn btn-dark btn-lg rounded-pill px-5 shadow {{ $hasOutOfStock ? 'disabled' : '' }}" {{ $hasOutOfStock ? 'onclick="return false;"' : '' }}>
                        <i class="fas fa-lock me-2"></i>Proceed to Checkout
                    </a>
                </div>
            @endif
        </div>
    </section>

    <script>
        // Auto-dismiss alerts after specified time
        document.querySelectorAll('.auto-dismiss').forEach(alert => {
            const dismissTime = parseInt(alert.getAttribute('data-dismiss-time')) || 8000;
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }, dismissTime);
        });

        document.querySelectorAll('.qty-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.dataset.id;
                const action = this.dataset.action;
                const input = document.querySelector(`.qty-input[data-id="${productId}"]`);
                let qty = parseInt(input.value);

                if(action === 'increase') qty++;
                if(action === 'decrease') qty = Math.max(1, qty - 1);

                input.value = qty;

                // Send AJAX to update cart
                fetch("{{ route('cart.update') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ product_id: productId, quantity: qty })
                })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success){
                            // Update subtotal and total
                            const row = input.closest('tr');
                            row.querySelector('td.fw-bold').textContent = `PKR ${data.itemTotal.toFixed(2)}`;
                            document.querySelector('.text-end h4').textContent = `Total: PKR ${data.cartTotal.toFixed(2)}`;
                        }
                    });
            });
        });
    </script>


@endsection
