@extends('layouts.layout')

@section('title', 'Emilliä - Products')

@section('content')
    <section class="py-5 bg-light" style="margin-top: 5rem;">
        <div class="container">
            <div class="text-center mb-5">
                <p class="text-uppercase text-muted small mb-2">Shop the new arrivals</p>
                <h1 class="fw-bold">Our Collection</h1>
                <p class="text-muted">Discover the perfect piece to express your unique style.</p>
            </div>

        

            <form method="GET" action="{{ route('products') }}" class="row g-3 align-items-end mb-4">
                <div class="col-12 col-md-4">
                    <label class="form-label fw-semibold d-md-none">Search</label>
                    <input
                        type="text"
                        name="query"
                        class="form-control rounded-pill"
                        placeholder="🔍 Search for jewelry..."
                        value="{{ request('query') }}">
                </div>

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

                <div class="col-6 col-md-2 text-md-end">
                    <button type="submit" class="btn btn-dark rounded-pill w-100">Filter</button>
                </div>
            </form>

            @if($products->isEmpty())
                <div class="text-center py-5">
                    <h4 class="fw-semibold">No products found</h4>
                    <p class="text-muted">Try a different search term or come back soon!</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card border-0 shadow-sm h-100 position-relative">
                                <a href="{{ route('products.show', $product) }}" class="stretched-link"></a>
                                <div class="ratio ratio-1x1 bg-white">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded-top object-fit-cover">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="fw-semibold">{{ $product->name }}</h5>
                                    <p class="text-muted small flex-grow-1">{{ \Illuminate\Support\Str::limit($product->description, 90) }}</p>
                                    <span class="fw-bold mt-3">PKR {{ number_format($product->price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </section>
@endsection


