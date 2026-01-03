@extends('layouts.layout')

@section('title', 'Your Cart - Emilliä Jewellery')

@section('content')
    <br><br><br><br>
    <section class="cart-section py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold mb-4 text-center">🛍️ Your Shopping Cart</h2>

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
                    <h5 class="text-muted">Your cart is empty.</h5>
                    <a href="{{ url('/products') }}" class="btn btn-dark rounded-pill mt-3 px-4">Continue Shopping</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle bg-white shadow-sm rounded-3 overflow-hidden">
                        <thead class="table-dark">
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                @foreach($cart as $item)
                            <tr class="{{ !($item['is_in_stock'] ?? true) ? 'table-warning' : '' }}">
                                <td class="text-center">
                            <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="img-fluid rounded" style="width: 80px; height: 80px; object-fit: cover;">
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

                <div class="text-end mt-4">
                    <h4 class="fw-bold">Total: PKR {{ number_format($total, 2) }}</h4>
                </div>

                <div class="d-flex flex-wrap justify-content-between mt-4">
                    <a href="{{ url('/products') }}" class="btn btn-outline-dark rounded-pill px-4 mb-2">← Continue Shopping</a>

                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger rounded-pill px-4 mb-2">Clear Cart</button>
                    </form>

                    @php
                        $hasOutOfStock = collect($cart)->contains(function($item) {
                            return !($item['is_in_stock'] ?? true);
                        });
                    @endphp
                    @if($hasOutOfStock)
                        <div class="alert alert-warning mb-3">
                            <strong>⚠️ Warning:</strong> Some items in your cart are out of stock. Please remove them before proceeding to checkout.
                        </div>
                    @endif
                    <a href="{{ route('checkout') }}" class="btn btn-dark rounded-pill px-4 mb-2 {{ $hasOutOfStock ? 'disabled' : '' }}" {{ $hasOutOfStock ? 'onclick="return false;"' : '' }}>Proceed to Checkout</a>
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
