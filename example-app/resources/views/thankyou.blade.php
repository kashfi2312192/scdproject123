@extends('layouts.layout')

@section('title', 'Order Successful - Emilliä Jewellery')

@section('content')
    <section class="py-5 bg-light">
        <div class="container text-center">
            <div class="card border-0 shadow mx-auto" style="max-width:700px;">
                <div class="card-body p-5 p-md-6">
                    <div class="mb-4">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                            <i class="fas fa-check-circle text-success" style="font-size: 70px;"></i>
                        </div>
                    </div>

                    <h2 class="fw-bold display-4 mb-3">Thank You for Your Order! 💕</h2>
                    <p class="lead text-muted mb-4">
                        Your purchase has been received and is being processed.<br>
                        We will contact you soon with shipping details.
                    </p>

                    @if(session('success'))
                        <div class="alert alert-success rounded mb-4">{{ session('success') }}</div>
                    @endif

                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center mt-5">
                        <a href="{{ url('/products') }}" class="btn btn-dark btn-lg rounded-pill px-5 py-3 shadow">
                            <i class="fas fa-shopping-cart me-2"></i>Continue Shopping
                        </a>

                        <a href="{{ url('/') }}" class="btn btn-outline-dark btn-lg rounded-pill px-5 py-3">
                            <i class="fas fa-home me-2"></i>Return Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

