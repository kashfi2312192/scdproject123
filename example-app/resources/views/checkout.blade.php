@extends('layouts.layout')

@section('title', 'Checkout - Emilliä Jewellery')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-dark text-white px-3 py-2 mb-3">Secure Checkout</span>
                <h2 class="fw-bold display-4 mb-3">Checkout</h2>
                <p class="lead text-muted">Complete your order with secure payment</p>
            </div>

            @if(empty($cart))
                <div class="text-center py-5">
                    <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                    <h4 class="fw-bold mb-2">Your cart is empty</h4>
                    <p class="text-muted mb-4">Add items to your cart to proceed with checkout</p>
                    <a href="{{ url('/products') }}" class="btn btn-dark btn-lg rounded-pill px-5">
                        <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                    </a>
                </div>
            @else
                <div class="row g-4">
                    <!-- ORDER SUMMARY -->
                    <div class="col-lg-6">
                        <div class="card border-0 shadow h-100">
                            <div class="card-header bg-dark text-white">
                                <h5 class="mb-0 fw-bold"><i class="fas fa-shopping-bag me-2"></i>Order Summary</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="list-group list-group-flush">
                                    @foreach($cart as $item)
                                        <div class="list-group-item border-0 px-0 py-3 d-flex align-items-center">
                                            <img src="{{ $item['image_url'] ?? asset('img/logo.webp') }}" alt="{{ $item['name'] }}" class="rounded shadow-sm me-3" style="width:80px; height:80px; object-fit:cover;">
                                            <div class="flex-grow-1">
                                                <strong class="d-block mb-1">{{ $item['name'] }}</strong>
                                                <small class="text-muted">Quantity: {{ $item['quantity'] }}</small>
                                            </div>
                                            <div class="text-end">
                                                <strong class="text-primary">PKR {{ number_format($item['price'] * $item['quantity'], 2) }}</strong>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <hr class="my-4">
                                <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded">
                                    <h5 class="fw-bold mb-0">Total Amount:</h5>
                                    <h4 class="fw-bold text-primary mb-0">PKR {{ number_format($total, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CHECKOUT FORM -->
                    <div class="col-lg-6">
                        <div class="card border-0 shadow h-100">
                            <div class="card-header bg-dark text-white">
                                <h5 class="mb-0 fw-bold"><i class="fas fa-user me-2"></i>Billing Details</h5>
                            </div>
                            <div class="card-body p-4">

                            <form action="{{ route('checkout.process') }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label class="form-label fw-bold"><i class="fas fa-user me-2 text-primary"></i>Full Name</label>
                                    <input type="text" name="name" class="form-control form-control-lg rounded-pill" placeholder="Enter your full name" value="{{ auth()->user()->name ?? '' }}" required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold"><i class="fas fa-envelope me-2 text-primary"></i>Email</label>
                                    <input type="email" name="email" class="form-control form-control-lg rounded-pill" placeholder="your@email.com" value="{{ auth()->user()->email ?? '' }}" required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold"><i class="fas fa-phone me-2 text-primary"></i>Phone</label>
                                    <input type="text" name="phone" class="form-control form-control-lg rounded-pill" placeholder="(012)-345-67890" required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Shipping Address</label>
                                    <textarea name="address" class="form-control rounded" rows="3" placeholder="Enter your complete shipping address" required></textarea>
                                </div>

                                <h5 class="fw-bold mt-4 mb-3"><i class="fas fa-credit-card me-2 text-primary"></i>Payment Method</h5>

                                <div class="form-check mb-3 p-3 bg-light rounded">
                                    <input class="form-check-input payment-option" type="radio" name="payment_method" value="cod" id="cod" checked>
                                    <label class="form-check-label fw-semibold" for="cod">
                                        <i class="fas fa-money-bill-wave me-2"></i>Cash on Delivery
                                    </label>
                                </div>

                                <div class="form-check mb-3 p-3 bg-light rounded">
                                    <input class="form-check-input payment-option" type="radio" name="payment_method" value="card" id="card">
                                    <label class="form-check-label fw-semibold" for="card">
                                        <i class="fas fa-credit-card me-2"></i>Credit/Debit Card
                                    </label>
                                </div>

                                <!-- CARD FORM -->
                                <div id="card-details" style="display: none;" class="bg-light p-4 rounded mb-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Card Number</label>
                                        <input type="text" name="card_number" class="form-control form-control-lg rounded-pill" placeholder="xxxx xxxx xxxx xxxx">
                                    </div>

                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="form-label fw-bold">Expiry</label>
                                            <input type="text" name="expiry" class="form-control form-control-lg rounded-pill" placeholder="MM/YY">
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label class="form-label fw-bold">CVV</label>
                                            <input type="text" name="cvv" class="form-control form-control-lg rounded-pill" placeholder="***">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-dark btn-lg w-100 rounded-pill py-3 shadow fw-bold">
                                    <i class="fas fa-lock me-2"></i>Place Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <script>
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('change', function() {
                if (this.value === "card") {
                    document.getElementById('card-details').style.display = "block";
                } else {
                    document.getElementById('card-details').style.display = "none";
                }
            });
        });
    </script>

@endsection
