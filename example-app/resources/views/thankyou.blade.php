@extends('layouts.layout')

@section('title', 'Order Successful - Emilliä Jewellery')

@section('content')
    <br><br><br><br>

    <section class="py-5 bg-light">
        <div class="container text-center">

            <div class="bg-white p-5 shadow rounded-3 mx-auto" style="max-width:600px;">

                <div class="mb-4">
                <span class="text-success" style="font-size: 70px;">
                    ✅
                </span>
                </div>

                <h2 class="fw-bold mb-2">Thank You for Your Order! 💕</h2>
                <p class="text-muted mb-4">
                    Your purchase has been received and is being processed.<br>
                    We will contact you soon with shipping details.
                </p>

                @if(session('success'))
                    <div class="alert alert-success mb-4">{{ session('success') }}</div>
                @endif

                <a href="{{ url('/products') }}" class="btn btn-dark rounded-pill px-4 mt-2">
                    Continue Shopping
                </a>

                <a href="{{ url('/') }}" class="btn btn-outline-dark rounded-pill px-4 mt-2">
                    Return Home
                </a>
            </div>

        </div>
    </section>
@endsection

