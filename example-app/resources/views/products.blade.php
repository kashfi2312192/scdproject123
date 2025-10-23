@extends('layouts.layout')

@section('title', 'Emilliä - Product')

@section('content')
    <br><br><br>
    <section class="collection-section py-5 bg-light">
        <div class="container">
            <!-- Title -->
            <div class="text-center mb-5">
                <h1 class="fw-bold">Our Collection</h1>
                <p class="text-muted">Discover the perfect piece to express your unique style.</p>
            </div>

            <!-- Filter Section -->
            <form method="GET" action="{{ route('products') }}" class="row g-3 align-items-end mb-4">
                <!-- Search -->
                <div class="col-12 col-md-4">
                    <label class="form-label fw-semibold d-md-none">Search</label>
                    <input
                        type="text"
                        name="query"
                        class="form-control rounded-pill"
                        placeholder="🔍 Search for jewelry..."
                        value="{{ request('query') }}">
                </div>

                <!-- Category -->
                <div class="col-6 col-md-2">
                    <label class="form-label fw-semibold d-md-none">Category</label>
                    <select name="category" class="form-select rounded-pill">
                        <option value="">All Categories</option>
                        <option value="Rings" {{ request('category')=='Rings' ? 'selected' : '' }}>Rings</option>
                        <option value="Bracelets" {{ request('category')=='Bracelets' ? 'selected' : '' }}>Bracelets</option>
                        <option value="Earrings" {{ request('category')=='Earrings' ? 'selected' : '' }}>Earrings</option>
                        <option value="Necklaces" {{ request('category')=='Necklaces' ? 'selected' : '' }}>Necklaces</option>
                    </select>
                </div>

                <!-- Material -->
                <div class="col-6 col-md-2">
                    <label class="form-label fw-semibold d-md-none">Material</label>
                    <select name="material" class="form-select rounded-pill">
                        <option value="">All Materials</option>
                        <option value="Gold" {{ request('material')=='Gold' ? 'selected' : '' }}>Gold</option>
                        <option value="Silver" {{ request('material')=='Silver' ? 'selected' : '' }}>Silver</option>
                        <option value="Diamond" {{ request('material')=='Diamond' ? 'selected' : '' }}>Diamond</option>
                        <option value="Pearl" {{ request('material')=='Pearl' ? 'selected' : '' }}>Pearl</option>
                    </select>
                </div>

                <!-- Style -->
                <div class="col-6 col-md-2">
                    <label class="form-label fw-semibold d-md-none">Style</label>
                    <select name="style" class="form-select rounded-pill">
                        <option value="">All Styles</option>
                        <option value="Classic" {{ request('style')=='Classic' ? 'selected' : '' }}>Classic</option>
                        <option value="Modern" {{ request('style')=='Modern' ? 'selected' : '' }}>Modern</option>
                        <option value="Minimalist" {{ request('style')=='Minimalist' ? 'selected' : '' }}>Minimalist</option>
                        <option value="Boho" {{ request('style')=='Boho' ? 'selected' : '' }}>Boho</option>
                    </select>
                </div>

                <!-- Filter Button -->
                <div class="col-6 col-md-2 text-md-end">
                    <button type="submit" class="btn btn-dark rounded-pill w-100">Filter</button>
                </div>
            </form>


            <!-- Product Grid -->
            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="text-center p-3 shadow-lg rounded-3 bg-white h-100 d-flex flex-column position-relative">
                            <a href="{{ route('products.show', $product['slug']) }}" class="stretched-link"></a>

                            <img src="{{ asset('img/' . $product['image']) }}" alt="{{ $product['name'] }}" class="img-fluid mb-3" style="max-height: 160px; object-fit: cover;">
                            <h5 class="fw-bold">{{ $product['name'] }}</h5>
                            <p class="text-muted small mb-2">{{ $product['short'] }}</p>
                            <p class="mb-3"><strong>PKR {{ number_format($product['price']) }}</strong></p>

                            <div class="mt-auto">
                                <a href="{{ route('products.show', $product['slug']) }}" class="btn btn-sm text-white w-100" style="background-color: #dc2d34;">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection

