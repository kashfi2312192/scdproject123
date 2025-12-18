@extends('layouts.layout')

@section('title', 'Emilliä - ' . $product->name)

@section('content')
    <section class="product-page py-5 bg-light mt-5">
        <div class="container">
            <div class="row align-items-center g-5">

                <!-- Product Image -->
                <div class="col-12 col-md-6 text-center">
                    <img src="{{ $product->image_url }}"
                         alt="{{ $product->name }}"
                         class="img-fluid rounded shadow-sm w-100 w-md-75">
                </div>

                <!-- Product Details -->
                <div class="col-12 col-md-6">
                    <h2 class="fw-bold mb-2 fs-3 fs-md-2">{{ $product->name }}</h2>

                    <p class="text-muted small mb-2">
                        <strong>{{ $averageRating > 0 ? number_format($averageRating, 1) : 'No ratings yet' }}</strong>
                        @if($reviewsCount > 0)
                            · {{ $reviewsCount }} review{{ $reviewsCount === 1 ? '' : 's' }}
                        @endif
                        <a href="#reviewsList" class="text-decoration-none ms-2">VIEW ALL REVIEWS</a>
                    </p>

                    <div class="d-flex align-items-baseline gap-3 mb-3 flex-wrap">
                        <h4 class="fw-bold text-dark mb-0">PKR {{ number_format($product->price, 2) }}</h4>
                    </div>

                    <p class="text-secondary small">{{ $product->description ?? 'No description available.' }}</p>

                    <p class="text-danger fw-semibold small mb-1">
                        Ships worldwide in 3–5 business days.
                    </p>

                    <p class="mb-1 small"><strong>Available:</strong> In stock</p>
                    <p class="mb-1 small">
                        <strong>Created:</strong> {{ optional($product->created_at)->format('M d, Y') ?? 'N/A' }}
                    </p>

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
                        <p>{{ $product->description ?? 'No additional details available.' }}</p>
                    </div>
                    <div class="tab-pane fade" id="delivery" role="tabpanel">
                        <p>We aim to deliver your order within 3–5 business days. All shipments are tracked and insured.</p>
                    </div>
                    <div class="tab-pane fade" id="shipping" role="tabpanel">
                        <p>Returns accepted within 14 days of delivery. Items must be unworn and in original packaging.</p>
                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div id="reviewsList" class="mb-4">
                            @forelse($product->reviews as $review)
                                <div class="border rounded-3 p-3 mb-3 bg-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong>{{ $review->author_name }}</strong>
                                        <span class="text-warning">
                                            {!! str_repeat('★', $review->rating) !!}
                                            {!! str_repeat('☆', 5 - $review->rating) !!}
                                        </span>
                                    </div>
                                    <p class="text-muted small mb-0">{{ $review->created_at->diffForHumans() }}</p>
                                    <p class="mb-2 mt-2">{{ $review->comment }}</p>
                                    @if($review->image_url)
                                        <div class="mt-2">
                                            <img src="{{ $review->image_url }}" alt="Review image" class="img-thumbnail" style="max-width: 300px; max-height: 300px; object-fit: contain;">
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <p class="text-muted mb-0">No reviews yet. Be the first to share your thoughts!</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="container mt-5">
                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <form action="{{ route('products.reviews.store', $product) }}" method="POST" class="p-4 shadow-sm rounded-3 bg-white" enctype="multipart/form-data">
                    @csrf
                    <h3 class="mb-4 fw-bold">Customer Reviews</h3>
                    <h4 class="mb-3 fw-semibold">Write a Review</h4>

                    <div class="mb-3">
                        <label for="reviewName" class="form-label fw-bold">Your Name</label>
                        <input type="text" id="reviewName" name="author_name" class="form-control @error('author_name') is-invalid @enderror" value="{{ old('author_name') }}" required>
                        @error('author_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="reviewRating" class="form-label fw-bold">Rating</label>
                        <select id="reviewRating" name="rating" class="form-select @error('rating') is-invalid @enderror" required>
                            <option value="">Select Rating</option>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" @selected(old('rating') == $i)>
                                    {{ str_repeat('★', $i) }}{{ str_repeat('☆', 5 - $i) }}
                                </option>
                            @endfor
                        </select>
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="reviewComment" class="form-label fw-bold">Comment</label>
                        <textarea id="reviewComment" name="comment" class="form-control @error('comment') is-invalid @enderror" rows="4" required>{{ old('comment') }}</textarea>
                        @error('comment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="reviewImage" class="form-label fw-bold">Upload Image (Optional)</label>
                        <input type="file" id="reviewImage" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp">
                        <small class="form-text text-muted">Accepted formats: JPEG, PNG, GIF, WebP. Max size: 5MB</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <!-- Image Preview -->
                        <div id="imagePreviewContainer" class="mt-3" style="display: none;">
                            <img id="imagePreview" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 300px; object-fit: contain;">
                            <button type="button" id="removeImagePreview" class="btn btn-sm btn-danger mt-2">Remove Image</button>
                        </div>
                    </div>

                    <button type="submit" class="btn text-white px-4 py-2" style="background-color: black;">
                        Submit Review
                    </button>
                </form>
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
        // Add to Cart with AJAX
        document.getElementById('addToCartBtn').onclick = () => {
            const quantity = parseInt(quantityInput.value);
            const productData = {
                product_id: "{{ $product->id }}",
                quantity: quantity,
                _token: "{{ csrf_token() }}"
            };

            fetch("{{ route('cart.add') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
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

        // Image Preview for Review Form
        const reviewImageInput = document.getElementById('reviewImage');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const removeImagePreview = document.getElementById('removeImagePreview');

        if (reviewImageInput) {
            reviewImageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Validate file type
                    const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
                    if (!validTypes.includes(file.type)) {
                        alert('Please select a valid image file (JPEG, PNG, GIF, or WebP)');
                        this.value = '';
                        return;
                    }

                    // Validate file size (5MB = 5 * 1024 * 1024 bytes)
                    if (file.size > 5 * 1024 * 1024) {
                        alert('Image size must be less than 5MB');
                        this.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreviewContainer.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });

            removeImagePreview.addEventListener('click', function() {
                reviewImageInput.value = '';
                imagePreview.src = '';
                imagePreviewContainer.style.display = 'none';
            });
        }

    </script>
@endsection
