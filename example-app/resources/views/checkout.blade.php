@extends('layouts.layout')

@section('title', 'Checkout - Emilliä Jewellery')

@section('content')
    <br><br><br><br>

    <section class="checkout-section py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold mb-4 text-center">💳 Checkout</h2>

            @if(empty($cart))
                <div class="text-center py-5">
                    <h5 class="text-muted">Your cart is empty.</h5>
                    <a href="{{ url('/products') }}" class="btn btn-dark rounded-pill mt-3 px-4">Continue Shopping</a>
                </div>
            @else
                <div class="row g-4">
                    <!-- ORDER SUMMARY -->
                    <div class="col-lg-6">
                        <div class="bg-white shadow-sm p-4 rounded-3">
                            <h4 class="fw-bold mb-4">🛍️ Order Summary</h4>

                            <table class="table align-middle">
                                <tbody>
                                @foreach($cart as $item)
                                    <tr>
                                        <td width="70">
                                            <img src="{{ asset('img/' . $item['image']) }}" class="rounded" style="width:70px; height:70px; object-fit:cover;">
                                        </td>
                                        <td>
                                            <strong>{{ $item['name'] }}</strong><br>
                                            Qty: {{ $item['quantity'] }}
                                        </td>
                                        <td class="text-end">
                                            PKR {{ number_format($item['price'] * $item['quantity'], 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <hr>
                            <h5 class="fw-bold text-end">Total: PKR {{ number_format($total, 2) }}</h5>
                        </div>
                    </div>

                    <!-- CHECKOUT FORM -->
                    <div class="col-lg-6">
                        <div class="bg-white shadow-sm p-4 rounded-3">
                            <h4 class="fw-bold mb-4">👤 Billing Details</h4>

                            <form action="{{ route('checkout.process') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Shipping Address</label>
                                    <textarea name="address" class="form-control" rows="3" required></textarea>
                                </div>

                                <h5 class="fw-bold mt-4 mb-2">Payment Method</h5>

                                <div class="form-check mb-2">
                                    <input class="form-check-input payment-option" type="radio" name="payment_method" value="cod" checked>
                                    <label class="form-check-label">Cash on Delivery</label>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input payment-option" type="radio" name="payment_method" value="card">
                                    <label class="form-check-label">Credit/Debit Card</label>
                                </div>

                                <!-- CARD FORM -->
                                <div id="card-details" style="display: none;">
                                    <div class="mb-3">
                                        <label class="form-label">Card Number</label>
                                        <input type="text" name="card_number" class="form-control" placeholder="xxxx xxxx xxxx xxxx">
                                    </div>

                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="form-label">Expiry</label>
                                            <input type="text" name="expiry" class="form-control" placeholder="MM/YY">
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label class="form-label">CVV</label>
                                            <input type="text" name="cvv" class="form-control" placeholder="***">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 mt-3 fw-bold">Place Order</button>
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
