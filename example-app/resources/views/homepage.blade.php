@extends('layouts.layout')

@section('content')

    <!-- ===== Hero Section (Bootstrap Carousel) ===== -->
    <section id="heroCarousel"
         class="carousel slide carousel-fade"
         data-bs-ride="carousel"
         data-bs-interval="8000">

    <!-- Indicators -->
    <div class="carousel-indicators mb-0">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active position-relative">
            <img src="{{ asset('img/banner1.webp') }}"
                 class="d-block w-100 vh-50 vh-md-75 object-fit-cover"
                 alt="Hero 1">

            <!-- Overlay Content -->
            <div class="carousel-caption text-start top-50 start-0 translate-middle-y ps-4 ps-md-5 w-100">
                <div class="container">
                    <div class="col-11 col-sm-9 col-md-7 col-lg-6">
                        <h6 class="fw-semibold text-uppercase mb-2 d-none d-sm-block">
                            Own Your Look
                        </h6>
                        <h1 class="fw-bold lh-sm mb-3 d-none d-md-block">
                            Accessorize With Confidence
                        </h1>
                        <p class="lead fs-6 fs-md-5 mb-3 d-none d-sm-block">
                            Luxury designs that define your elegance.
                        </p>
                        <a href="{{ url('/products') }}"
                           class="btn btn-light rounded-pill px-3 px-md-4 py-2 btn-sm">
                            Shop Now →
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item position-relative">
            <img src="{{ asset('img/banner2.webp') }}"
                 class="d-block w-100 vh-50 vh-md-75 object-fit-cover"
                 alt="Hero 2">

            <div class="carousel-caption text-start top-50 start-0 translate-middle-y ps-4 ps-md-5 w-100">
                <div class="container">
                    <div class="col-11 col-sm-9 col-md-7 col-lg-6">
                        <h6 class="fw-semibold text-uppercase mb-2 d-none d-sm-block">
                            Define Your Style
                        </h6>
                        <h1 class="fw-bold lh-sm mb-3 d-none d-md-block">
                            Ethereal Jewelry Designs
                        </h1>
                        <p class="lead fs-6 fs-md-5 mb-3 d-none d-sm-block">
                            Shine bright with modern, minimal beauty.
                        </p>
                        <a href="{{ url('/products') }}"
                           class="btn btn-light rounded-pill px-3 px-md-4 py-2 btn-sm">
                            Shop Now →
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item position-relative">
            <img src="{{ asset('img/banner3.webp') }}"
                 class="d-block w-100 vh-50 vh-md-75 object-fit-cover"
                 alt="Hero 3">

            <div class="carousel-caption text-start top-50 start-0 translate-middle-y ps-4 ps-md-5 w-100">
                <div class="container">
                    <div class="col-11 col-sm-9 col-md-7 col-lg-6">
                        <h6 class="fw-semibold text-uppercase mb-2 d-none d-sm-block">
                            Elevate Your Elegance
                        </h6>
                        <h1 class="fw-bold lh-sm mb-3 d-none d-md-block">
                            Timeless Pieces for Every Moment
                        </h1>
                        <p class="lead fs-6 fs-md-5 mb-3 d-none d-sm-block">
                            Designed to make your moments sparkle.
                        </p>
                        <a href="{{ url('/products') }}"
                           class="btn btn-light rounded-pill px-3 px-md-4 py-2 btn-sm">
                            Shop Now →
                        </a>
                    </div>
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
                <span class="badge bg-dark text-white px-3 py-2 mb-3">Our Collection</span>
                <h2 class="fw-bold display-4 mb-3">Our Collection</h2>
                <p class="lead text-muted">Click on a category to explore our curated jewelry pieces.</p>
            </div>

            @php
                $categories = \App\Models\Category::withCount('products')->orderBy('name')->get();
                $categoryImages = [
                    'Bracelets' => 'bracelet.webp',
                    'Rings' => 'rings.avif',
                    'Earrings' => 'earings.webp',
                    'Necklaces' => 'necklace.avif',
                ];
            @endphp

            <div class="row g-4 justify-content-center">
                @foreach($categories as $category)
                    <div class="col-6 col-sm-6 col-md-3">
                        <a href="{{ route('products', ['category' => $category->id]) }}" class="text-decoration-none text-dark">
                            <div class="card border-0 shadow h-100 overflow-hidden" style="cursor: pointer; transition: transform 0.2s;">
                                <img src="{{ asset('img/' . ($categoryImages[$category->name] ?? 'logo.webp')) }}" 
                                     class="card-img-top" 
                                     alt="{{ $category->name }}"
                                     style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-1">{{ $category->name }}</h5>
                                    <p class="text-muted small mb-0">
                                        <i class="fas fa-box me-1"></i>{{ $category->products_count }} {{ \Illuminate\Support\Str::plural('product', $category->products_count) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if($featuredProducts->isNotEmpty())
        <section class="py-5 bg-light">
            <div class="container">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
                    <div class="text-center text-md-start mb-3 mb-md-0">
                        <span class="badge bg-dark text-white px-3 py-2 mb-3">Trending Now</span>
                        <h2 class="fw-bold display-4 mb-2">Featured Products</h2>
                        <p class="lead text-muted">Discover our most popular jewelry pieces</p>
                    </div>
                    <a href="{{ route('products') }}" class="btn btn-dark btn-lg rounded-pill px-5 mt-3 mt-md-0">
                        <i class="fas fa-arrow-right me-2"></i>View All Products
                    </a>
                </div>

                <div class="row g-4">
                    @foreach($featuredProducts as $product)
                        <div class="col-12 col-sm-6 col-lg-3">
                            <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark">
                                <div class="card border-0 shadow h-100 overflow-hidden" style="cursor: pointer; transition: transform 0.2s;">
                                    <div class="position-relative">
                                        <div class="ratio ratio-1x1 bg-light">
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid object-fit-cover">
                                        </div>
                                        @if($product->category_name)
                                            <span class="badge bg-dark position-absolute top-0 end-0 m-2">{{ $product->category_name }}</span>
                                        @endif
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="fw-bold mb-2">{{ $product->name }}</h5>
                                        <p class="text-muted small flex-grow-1 mb-3">{{ \Illuminate\Support\Str::limit($product->description ?? 'Beautiful jewelry piece', 80) }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-bold fs-5 text-dark">PKR {{ number_format($product->price, 2) }}</span>
                                            <span class="btn btn-dark btn-sm rounded-pill">
                                                <i class="fas fa-eye me-1"></i>View
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <style>
        .card:hover {
            transform: translateY(-5px);
        }
    </style>


    <!-- ===== About Section ===== -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-md-6">
                    <video src="{{ asset('img/video.mp4') }}" autoplay muted loop class="w-100 rounded shadow"></video>
                </div>
                <div class="col-md-6">
                    <span class="badge bg-dark text-white px-3 py-2 mb-3">About Us</span>
                    <h2 class="fw-bold display-5 mb-3">How We Redefine Fashion Accessories For Everyone</h2>
                    <p class="lead text-muted mb-4">
                        Our approach to redefining fashion accessories focuses on inclusivity, diversity, and personal expression.
                        We curate a collection that caters to various styles, tastes and occasions.
                    </p>
                    <a href="#about" class="btn btn-dark btn-lg rounded-pill px-5 py-3 shadow">
                        <i class="fas fa-arrow-right me-2"></i>Read More About Us
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== Benefits Section ===== -->
    <section class="py-5 bg-white text-center">
    <div class="container">

        <div class="mb-4">
            <span class="badge bg-dark px-3 py-2 mb-2">Why Choose Us</span>
            <h2 class="fw-bold mb-2">Benefits</h2>
            <p class="text-muted small">What makes shopping with us special</p>
        </div>

        <div class="row g-3 justify-content-center">

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm h-100 text-center p-3">
                    <img src="{{ asset('img/freeshipping.webp') }}"
                         class="mx-auto mb-2 img-fluid"
                         style="max-height:45px;" alt="Free Shipping">
                    <h6 class="fw-semibold mb-1">Free Shipping</h6>
                    <p class="text-muted small mb-0">
                        On orders over $50
                    </p>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm h-100 text-center p-3">
                    <img src="{{ asset('img/buynowpaylater.webp') }}"
                         class="mx-auto mb-2 img-fluid"
                         style="max-height:45px;" alt="Buy Now Pay Later">
                    <h6 class="fw-semibold mb-1">Buy Now, Pay Later</h6>
                    <p class="text-muted small mb-0">
                        Easy installments
                    </p>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm h-100 text-center p-3">
                    <img src="{{ asset('img/cashbackreward.webp') }}"
                         class="mx-auto mb-2 img-fluid"
                         style="max-height:45px;" alt="Cashback Reward">
                    <h6 class="fw-semibold mb-1">Cashback Reward</h6>
                    <p class="text-muted small mb-0">
                        Earn on every purchase
                    </p>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm h-100 text-center p-3">
                    <img src="{{ asset('img/securepayment.webp') }}"
                         class="mx-auto mb-2 img-fluid"
                         style="max-height:45px;" alt="Secure Payments">
                    <h6 class="fw-semibold mb-1">Secure Payments</h6>
                    <p class="text-muted small mb-0">
                        Safe & protected checkout
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>


@endsection
