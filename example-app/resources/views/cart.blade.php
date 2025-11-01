@extends('layouts.layout')

@section('title', 'Your Cart - Emilliä Jewellery')

@section('content')
    <br><br><br><br>
    <section class="cart-section py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold mb-4 text-center">🛍️ Your Shopping Cart</h2>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
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
                            <tr>
                                <td class="text-center">
                                    <img src="{{ asset('img/' . $item['image']) }}" alt="{{ $item['name'] }}" class="img-fluid rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                </td>
                                <td class="fw-semibold">{{ $item['name'] }}</td>
                                <td>PKR {{ number_format($item['price'], 2) }}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-left">
                                        <button class="btn btn-sm btn-outline-dark me-2 qty-btn" data-slug="{{ $item['slug'] }}" data-action="decrease">-</button>
                                        <input type="text" value="{{ $item['quantity'] }}" class="form-control text-center qty-input" style="width: 50px;" data-slug="{{ $item['slug'] }}">
                                        <button class="btn btn-sm btn-outline-dark ms-2 qty-btn" data-slug="{{ $item['slug'] }}" data-action="increase">+</button>
                                    </div>
                                </td>

                                <td class="fw-bold">PKR {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td class="text-center">
                                    <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="slug" value="{{ $item['slug'] }}">
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

                    <button class="btn btn-dark rounded-pill px-4 mb-2"><a href="{{ route('checkout') }}" class="btn btn-dark w-100">Proceed to Checkout</a>
                    </button>
                </div>
            @endif
        </div>
    </section>

    <script>
        document.querySelectorAll('.qty-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const slug = this.dataset.slug;
                const action = this.dataset.action;
                const input = document.querySelector(`.qty-input[data-slug="${slug}"]`);
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
                    body: JSON.stringify({ slug: slug, quantity: qty })
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
