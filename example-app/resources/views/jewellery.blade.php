@extends('layouts.layout')

@section('title', 'Emilliä - ' . $product['name'])

@section('content')
    <section class="product-page py-5 bg-light mt-5">
        <div class="container">
            <div class="row align-items-center g-5">

                <!-- Product Image -->
                <div class="col-12 col-md-6 text-center">
                    <img src="{{ asset('img/' . $product['image']) }}"
                         alt="{{ $product['name'] }}"
                         class="img-fluid rounded shadow-sm w-100 w-md-75">
                </div>

                <!-- Product Details -->
                <div class="col-12 col-md-6">
                    <h2 class="fw-bold mb-2 fs-3 fs-md-2">{{ $product['name'] }}</h2>

                    <p class="text-muted small mb-2">(0)
                        <a href="#reviewsList" class="text-decoration-none">VIEW ALL REVIEWS</a>
                    </p>

                    <div class="d-flex align-items-baseline gap-3 mb-3 flex-wrap">
                        <h4 class="fw-bold text-dark mb-0">PKR {{ number_format($product['price']) }}</h4>
                        @if(!empty($product['old_price']))
                            <span class="text-decoration-line-through text-muted">
                            PKR {{ number_format($product['old_price']) }}
                        </span>
                        @endif
                        @if(!empty($product['discount']))
                            <span class="badge bg-danger">-{{ $product['discount'] }}%</span>
                        @endif
                    </div>

                    <p class="text-secondary small">{{ $product['description'] ?? 'No description available.' }}</p>

                    <p class="text-danger fw-semibold small mb-1">
                        {{ 100 - ($product['stock'] ?? 0) * 10 }}% Sold - Only {{ $product['stock'] ?? 'Few' }} item(s) left in stock!
                    </p>

                    <p class="mb-1 small"><strong>Available:</strong> In stock</p>
                    @if(!empty($product['tags']))
                        <p class="mb-1 small"><strong>Tags:</strong> {{ implode(', ', $product['tags']) }}</p>
                    @else
                        <p class="mb-1 small"><strong>Tags:</strong> No tags available</p>
                    @endif

                    <p class="mb-1 small"><strong>SKU:</strong> {{ $product['sku'] }}</p>
                    <p class="mb-1 small"><strong>Category:</strong> {{ $product['category'] }}</p>

                    <!-- Quantity Selector -->
                    <div class="d-flex align-items-center gap-3 mt-4 mb-3 flex-wrap">
                        <label class="fw-semibold me-2 small">Quantity:</label>
                        <div class="input-group" style="width: 130px;">
                            <button class="btn btn-outline-dark" type="button" id="decreaseQty">-</button>
                            <input type="text" class="form-control text-center" id="quantity" value="1">
                            <button class="btn btn-outline-dark" type="button" id="increaseQty">+</button>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex flex-wrap gap-2 gap-md-3">
                        <button class="btn btn-dark rounded-pill px-4" id="addToCartBtn">Add to Cart</button>
                        <button class="btn btn-outline-dark rounded-pill px-4">Share</button>
                        <button class="btn btn-outline-dark rounded-pill px-4">Ask a Question</button>
                        <button class="btn btn-outline-dark rounded-pill px-4">FAQ</button>
                    </div>

                    <!-- Success Message -->
                    <div id="cartMessage" class="alert alert-success mt-3 d-none" role="alert">
                        ✅ Product added to cart successfully!
                    </div>
                </div>
            </div>

            <!-- Tabs Section -->
            <div class="mt-5">
                <ul class="nav nav-tabs flex-wrap" id="productTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button" role="tab">Description</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab">Delivery Policy</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab">Shipping & Return</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">Reviews</button>
                    </li>
                </ul>

                <div class="tab-content border border-top-0 bg-white p-4" id="productTabsContent">
                    <div class="tab-pane fade show active" id="desc" role="tabpanel">
                        <p>{{ $product['description'] ?? 'No additional details available.' }}</p>
                    </div>
                    <div class="tab-pane fade" id="delivery" role="tabpanel">
                        <p>We aim to deliver your order within 3–5 business days. All shipments are tracked and insured.</p>
                    </div>
                    <div class="tab-pane fade" id="shipping" role="tabpanel">
                        <p>Returns accepted within 14 days of delivery. Items must be unworn and in original packaging.</p>
                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div id="reviewsList" class="mb-4">
                            <!-- Reviews will appear here -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="container mt-5">
                <div id="reviewsList" class="mb-4"></div>

                <form id="reviewForm" class="p-4 shadow-sm rounded-3 bg-white">
                    <h3 class="mb-4 fw-bold">Customer Reviews</h3>
                    <h4 class="mb-3 fw-semibold">Write a Review</h4>

                    <div class="mb-3">
                        <label for="reviewName" class="form-label fw-bold">Your Name</label>
                        <input type="text" id="reviewName" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="reviewRating" class="form-label fw-bold">Rating</label>
                        <select id="reviewRating" class="form-select" required>
                            <option value="">Select Rating</option>
                            <option value="5">★★★★★ - Excellent</option>
                            <option value="4">★★★★☆ - Good</option>
                            <option value="3">★★★☆☆ - Average</option>
                            <option value="2">★★☆☆☆ - Poor</option>
                            <option value="1">★☆☆☆☆ - Terrible</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="reviewComment" class="form-label fw-bold">Comment</label>
                        <textarea id="reviewComment" class="form-control" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="btn text-white px-4 py-2" style="background-color: #dc2d34;">
                        Submit Review
                    </button>
                </form>

                <div id="reviewSuccess" class="alert alert-success mt-3 d-none">
                    ✅ Thank you for your review!
                </div>
            </div>
        </div>
    </section>

    {{-- JS --}}
    <script>
        // Quantity
        const quantityInput = document.getElementById('quantity');
        document.getElementById('increaseQty').onclick = () => quantityInput.value++;
        document.getElementById('decreaseQty').onclick = () => {
            if (quantityInput.value > 1) quantityInput.value--;
        };

        // Add to Cart
        {{-- Add this inside your <script> section at the bottom --}}

        // Add to Cart with AJAX
        document.getElementById('addToCartBtn').onclick = () => {
            const quantity = parseInt(quantityInput.value);
            const productData = {
                slug: "{{ $product['slug'] }}",
                quantity: quantity,
                _token: "{{ csrf_token() }}"
            };

            fetch("{{ route('cart.add') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(productData)
            })
                .then(res => res.json())
                .then(data => {
                    if(data.success){
                        const msg = document.getElementById('cartMessage');
                        msg.textContent = data.message;
                        msg.classList.remove('d-none');
                        setTimeout(() => msg.classList.add('d-none'), 3000);
                    }
                })
                .catch(err => console.error(err));
        };


        // Review
        document.getElementById('reviewForm').addEventListener('submit', e => {
            e.preventDefault();

            const name = document.getElementById('reviewName').value;
            const rating = document.getElementById('reviewRating').value;
            const comment = document.getElementById('reviewComment').value;

            const newReview = document.createElement('div');
            newReview.classList.add('border', 'p-3', 'rounded', 'mb-3');
            newReview.innerHTML = `<strong>${name}</strong><br>
        <span class="text-warning">${'★'.repeat(rating)}${'☆'.repeat(5 - rating)}</span>
        <p class="mt-2">${comment}</p>`;

            // Append review to the reviews tab
            document.getElementById('reviewsList').appendChild(newReview);

            // Show success message
            const reviewSuccess = document.getElementById('reviewSuccess');
            reviewSuccess.classList.remove('d-none');

            // Reset the form
            e.target.reset();

            // Hide success message after 3 seconds
            setTimeout(() => reviewSuccess.classList.add('d-none'), 3000);

            // Switch to Reviews tab automatically
            const reviewsTab = new bootstrap.Tab(document.getElementById('reviews-tab'));
            reviewsTab.show();
        });

    </script>
@endsection
