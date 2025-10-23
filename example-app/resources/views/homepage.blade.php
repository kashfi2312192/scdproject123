@extends('layouts.layout')

@section('content')

    <!-- ===== Hero Section (Bootstrap Carousel) ===== -->
    <section id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="8000">
        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>

        <!-- Slides -->
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active position-relative">
                <img src="{{ asset('img/banner1.webp') }}"
                     class="d-block w-100 vh-50 vh-md-75 object-fit-cover"
                     alt="Hero 1">

                <!-- Caption -->
                <div
                    class="position-absolute top-50 start-0 translate-middle-y ps-5 ps-md-7 ms-5 ms-md-7 text-white w-100 w-md-75">
                    <div class="col-10 col-sm-8 col-md-6">
                        <h6 class="fw-semibold text-uppercase fs-6 fs-md-5 d-none d-sm-block">Own Your Look</h6>
                        <h1 class="fw-bold lh-sm fs-4 fs-md-2 fs-lg-1 d-none d-md-block">Accessorize With Confidence</h1>
                        <p class="lead d-none d-sm-block fs-6 fs-md-5">Luxury designs that define your elegance.</p>
                        <a href="{{ url('/products') }}"
                           class="btn btn-light rounded-pill px-2 px-md-4 py-1 py-md-2 mt-2 mt-md-3 btn-sm d-none d-sm-inline-block">
                            Shop Now →
                        </a>
                    </div>
                </div>

            </div>

            <!-- Slide 2 -->
            <div class="carousel-item position-relative">
                <img src="{{ asset('img/banner2.webp') }}"
                     class="d-block w-100 vh-50 vh-md-75 object-fit-cover"
                     alt="Hero 2">

                <div class="position-absolute top-50 start-0 translate-middle-y ps-5 ps-md-7 ms-5 ms-md-7 text-white w-100 w-md-75">
                    <div class="col-10 col-sm-8 col-md-6">
                        <h6 class="fw-semibold text-uppercase fs-6 fs-md-5 d-none d-sm-block">Define Your Style</h6>
                        <h1 class="fw-bold lh-sm fs-4 fs-md-2 fs-lg-1 d-none d-sm-block">Ethereal Jewelry Designs</h1>
                        <p class="lead d-none d-sm-block fs-6 fs-md-5 d-none d-sm-block">Shine bright with modern, minimal beauty.</p>
                        <a href="{{ url('/products') }}"
                           class="btn btn-light rounded-pill px-2 px-md-4 py-1 py-md-2 mt-2 mt-md-3 btn-sm d-none d-sm-inline-block">
                            Shop Now →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item position-relative">
                <img src="{{ asset('img/banner3.webp') }}"
                     class="d-block w-100 vh-50 vh-md-75 object-fit-cover"
                     alt="Hero 3">

                <div class="position-absolute top-50 start-0 translate-middle-y ps-5 ps-md-7 ms-5 ms-md-7 text-white w-100 w-md-75">
                    <div class="col-10 col-sm-8 col-md-6">
                        <h6 class="fw-semibold text-uppercase fs-6 fs-md-5 d-none d-sm-block">Elevate Your Elegance</h6>
                        <h1 class="fw-bold lh-sm fs-4 fs-md-2 fs-lg-1 d-none d-sm-block">Timeless Pieces for Every Moment</h1>
                        <p class="lead d-none d-sm-block fs-6 fs-md-5 d-none d-sm-block">Designed to make your moments sparkle.</p>
                        <a href="{{ url('/products') }}"
                           class="btn btn-light rounded-pill px-2 px-md-4 py-1 py-md-2 mt-2 mt-md-3 btn-sm d-none d-sm-inline-block">
                            Shop Now →
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </section>





    <!-- ===== Categories Section ===== -->
    <section class="py-5 bg-white">
        <div class="container text-center">

            <!-- Our Collection Heading -->
            <div class="mb-5">
                <h2 class="fw-bold">Our Collection</h2>
                <p class="text-muted">Click on a category to explore our curated jewelry pieces.</p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-6 col-sm-6 col-md-3">
                    <a href="{{ route('products', ['category' => 'Bracelets']) }}" class="text-decoration-none text-dark">
                        <div class="card border-0 shadow-sm hover-scale">
                            <img src="{{ asset('img/bracelet.webp') }}" class="card-img-top rounded-top" alt="Bracelet">
                            <div class="card-body">
                                <h5 class="fw-bold mb-1">Bracelet</h5>
                                <p class="text-muted small mb-0">12 products</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-sm-6 col-md-3">
                    <a href="{{ route('products', ['category' => 'Rings']) }}" class="text-decoration-none text-dark">
                        <div class="card border-0 shadow-sm hover-scale">
                            <img src="{{ asset('img/rings.avif') }}" class="card-img-top rounded-top" alt="Rings">
                            <div class="card-body">
                                <h5 class="fw-bold mb-1">Rings</h5>
                                <p class="text-muted small mb-0">15 products</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-sm-6 col-md-3">
                    <a href="{{ route('products', ['category' => 'Earrings']) }}" class="text-decoration-none text-dark">
                        <div class="card border-0 shadow-sm hover-scale">
                            <img src="{{ asset('img/earings.webp') }}" class="card-img-top rounded-top" alt="Earrings">
                            <div class="card-body">
                                <h5 class="fw-bold mb-1">Earrings</h5>
                                <p class="text-muted small mb-0">30 products</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-sm-6 col-md-3">
                    <a href="{{ route('products', ['category' => 'Necklaces']) }}" class="text-decoration-none text-dark">
                        <div class="card border-0 shadow-sm hover-scale">
                            <img src="{{ asset('img/necklace.avif') }}" class="card-img-top rounded-top" alt="Necklace">
                            <div class="card-body">
                                <h5 class="fw-bold mb-1">Necklace</h5>
                                <p class="text-muted small mb-0">18 products</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional CSS for hover effect -->
    <style>
        .hover-scale:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }
    </style>


    <!-- ===== About Section ===== -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-md-6">
                    <video src="{{ asset('img/video.mp4') }}" autoplay muted loop class="w-100 rounded"></video>
                </div>
                <div class="col-md-6">
                    <p class="text-uppercase text-muted small mb-2">About Us</p>
                    <h2 class="fw-bold mb-3">How We Redefine Fashion Accessories For Everyone</h2>
                    <p class="text-muted mb-4">
                        Our approach to redefining fashion accessories focuses on inclusivity, diversity, and personal expression.
                        We curate a collection that caters to various styles, tastes and occasions.
                    </p>
                    <a href="#about" class="btn btn-dark rounded-pill px-4 py-2">Read More About Us ↗</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== Benefits Section ===== -->
    <section class="py-5 bg-white text-center">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-sm-6 col-md-3">
                    <img src="{{ asset('img/freeshipping.webp') }}" alt="Free Shipping" class="mb-3" height="40">
                    <h5 class="fw-bold mb-2">Free Shipping</h5>
                    <p class="text-muted small mb-0">Enjoy the convenience of free shipping on all orders over $50.</p>
                </div>

                <div class="col-6 col-sm-6 col-md-3">
                    <img src="{{ asset('img/buynowpaylater.webp') }}" alt="Buy Now Pay Later" class="mb-3" height="40">
                    <h5 class="fw-bold mb-2">Buy Now, Pay Later</h5>
                    <p class="text-muted small mb-0">Shop now, pay later — get your favorite jewelry in easy installments!</p>
                </div>

                <div class="col-6 col-sm-6 col-md-3">
                    <img src="{{ asset('img/cashbackreward.webp') }}" alt="Cashback Reward" class="mb-3" height="40">
                    <h5 class="fw-bold mb-2">Cashback Reward</h5>
                    <p class="text-muted small mb-0">Earn cashback on every purchase and save on your next jewelry order!</p>
                </div>

                <div class="col-6 col-sm-6 col-md-3">
                    <img src="{{ asset('img/securepayment.webp') }}" alt="Secure Payments" class="mb-3" height="40">
                    <h5 class="fw-bold mb-2">Secure Payments</h5>
                    <p class="text-muted small mb-0">Shop confidently with secure payments that protect your information!</p>
                </div>
            </div>
        </div>
    </section>

@endsection
