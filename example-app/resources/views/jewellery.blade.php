@extends('layouts.layout')

@section('title', 'Emilliä - ' . $product->name)

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center g-5">

                <!-- Product Image -->
                <div class="col-12 col-md-6 text-center">
                    <div class="position-relative">
                        <img src="{{ $product->image_url }}"
                             alt="{{ $product->name }}"
                             class="img-fluid rounded shadow w-100 w-md-90">
                        @if($product->category_name)
                            <span class="badge bg-dark position-absolute top-0 end-0 m-3">{{ $product->category_name }}</span>
                        @endif
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-12 col-md-6">
                    <h1 class="fw-bold display-4 mb-3">{{ $product->name }}</h1>

                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="d-flex align-items-center">
                            @if($averageRating > 0)
                                <span class="text-warning me-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $averageRating ? '' : '-empty' }}"></i>
                                    @endfor
                                </span>
                                <strong class="me-2">{{ number_format($averageRating, 1) }}</strong>
                            @else
                                <span class="text-muted">No ratings yet</span>
                            @endif
                        </div>
                        @if($reviewsCount > 0)
                            <span class="text-muted">·</span>
                            <span class="text-muted">{{ $reviewsCount }} review{{ $reviewsCount === 1 ? '' : 's' }}</span>
                            <a href="#reviews" class="text-decoration-none ms-2 fw-semibold" id="viewAllReviewsLink">
                                <i class="fas fa-arrow-down me-1"></i>VIEW ALL REVIEWS
                            </a>
                        @endif
                    </div>

                    <div class="d-flex align-items-baseline gap-3 mb-4 flex-wrap">
                        <h3 class="fw-bold text-dark mb-0">PKR {{ number_format($product->price, 2) }}</h3>
                    </div>

                    <p class="lead text-muted mb-4">{{ $product->description ?? 'No description available.' }}</p>

                    <div class="bg-light rounded p-4 mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-shipping-fast text-primary me-3 fs-5"></i>
                            <div>
                                <strong class="d-block">Free Shipping</strong>
                                <small class="text-muted">Ships worldwide in 3–5 business days</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check-circle text-{{ $product->is_in_stock ? 'success' : 'danger' }} me-3 fs-5"></i>
                            <div>
                                <strong class="d-block">Availability</strong>
                                <span class="text-{{ $product->is_in_stock ? 'success' : 'danger' }} fw-bold">
                                    {{ $product->is_in_stock ? 'In Stock' : 'Out of Stock' }}
                                </span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-calendar text-primary me-3 fs-5"></i>
                            <div>
                                <strong class="d-block">Created</strong>
                                <small class="text-muted">{{ optional($product->created_at)->format('M d, Y') ?? 'N/A' }}</small>
                            </div>
                        </div>
                    </div>

                    <!-- Quantity Selector -->
                    <div class="d-flex align-items-center gap-3 mt-4 mb-4 flex-wrap">
                        <label class="fw-bold mb-0">Quantity:</label>
                        <div class="input-group" style="width: 150px;">
                            <button class="btn btn-outline-dark rounded-start-pill" type="button" id="decreaseQty">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="text" class="form-control text-center fw-bold" id="quantity" value="1" style="border-left: none; border-right: none;">
                            <button class="btn btn-outline-dark rounded-end-pill" type="button" id="increaseQty">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <button class="btn btn-dark btn-lg rounded-pill px-5 py-3 shadow flex-grow-1" id="addToCartBtn" {{ !$product->is_in_stock ? 'disabled' : '' }}>
                            <i class="fas fa-shopping-cart me-2"></i>{{ $product->is_in_stock ? 'Add to Cart' : 'Out of Stock' }}
                        </button>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-outline-dark rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#shareModal">
                            <i class="fas fa-share-alt me-2"></i>Share
                        </button>
                        <button class="btn btn-outline-dark rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#askQuestionModal">
                            <i class="fas fa-question-circle me-2"></i>Ask a Question
                        </button>
                        <button class="btn btn-outline-dark rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#faqModal">
                            <i class="fas fa-info-circle me-2"></i>FAQ
                        </button>
                    </div>

                    <!-- Success/Error Messages -->
                    <div id="cartMessage" class="alert alert-success mt-3 d-none" role="alert">
                        ✅ Product added to cart successfully!
                    </div>
                    <div id="cartErrorMessage" class="alert alert-danger mt-3 d-none" role="alert">
                    </div>
                </div>
            </div>

            <!-- Tabs Section -->
            <div class="mt-5">
                <ul class="nav nav-pills nav-justified flex-wrap mb-4" id="productTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-pill me-2 mb-2" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button" role="tab">
                            <i class="fas fa-file-alt me-2"></i>Description
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill me-2 mb-2" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab">
                            <i class="fas fa-truck me-2"></i>Delivery Policy
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill me-2 mb-2" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab">
                            <i class="fas fa-undo me-2"></i>Shipping & Return
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill mb-2" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">
                            <i class="fas fa-star me-2"></i>Reviews ({{ $reviewsCount }})
                        </button>
                    </li>
                </ul>

                <div class="tab-content border-0 bg-white shadow rounded p-4 p-md-5" id="productTabsContent">
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
                                        <div class="mt-3">
                                            <img src="{{ $review->image_url }}" alt="Review image" class="img-thumbnail rounded shadow-sm" style="max-width: 300px; max-height: 300px; object-fit: cover; width: 300px; height: 300px;">
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <i class="fas fa-star fa-3x text-muted mb-3"></i>
                                    <p class="text-muted lead mb-4">No reviews yet. Be the first to share your thoughts!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="container mt-5">
                @if(session('status'))
                    <div class="alert alert-success rounded">{{ session('status') }}</div>
                @endif

                <form action="{{ route('products.reviews.store', $product) }}" method="POST" class="card border-0 shadow p-4 p-md-5" enctype="multipart/form-data">
                    @csrf
                    <div class="text-center mb-4">
                        <span class="badge bg-dark text-white px-3 py-2 mb-3">Write a Review</span>
                        <h3 class="fw-bold display-5 mb-2">Customer Reviews</h3>
                        <p class="text-muted">Share your experience with this product</p>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="reviewName" class="form-label fw-bold mb-2">
                                <i class="fas fa-user me-2 text-primary"></i>Your Name
                            </label>
                            <input type="text" id="reviewName" name="author_name" class="form-control form-control-lg rounded-pill @error('author_name') is-invalid @enderror" value="{{ old('author_name') }}" placeholder="Enter your name" required>
                            @error('author_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="reviewRating" class="form-label fw-bold mb-2">
                                <i class="fas fa-star me-2 text-primary"></i>Rating
                            </label>
                            <select id="reviewRating" name="rating" class="form-select form-select-lg rounded-pill @error('rating') is-invalid @enderror" required>
                                <option value="">Select Rating</option>
                                @for($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" @selected(old('rating') == $i)>
                                        {{ str_repeat('★', $i) }}{{ str_repeat('☆', 5 - $i) }} {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="reviewComment" class="form-label fw-bold mb-2">
                            <i class="fas fa-comment me-2 text-primary"></i>Comment
                        </label>
                        <textarea id="reviewComment" name="comment" class="form-control rounded @error('comment') is-invalid @enderror" rows="5" placeholder="Share your thoughts about this product..." required>{{ old('comment') }}</textarea>
                        @error('comment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="reviewImage" class="form-label fw-bold mb-2">
                            <i class="fas fa-image me-2 text-primary"></i>Upload Image (Optional)
                        </label>
                        <input type="file" id="reviewImage" name="image" class="form-control form-control-lg rounded-pill @error('image') is-invalid @enderror" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp">
                        <small class="form-text text-muted mt-2 d-block">
                            <i class="fas fa-info-circle me-1"></i>Accepted formats: JPEG, PNG, GIF, WebP. Max size: 5MB
                        </small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <!-- Image Preview -->
                        <div id="imagePreviewContainer" class="mt-3" style="display: none;">
                            <img id="imagePreview" src="" alt="Preview" class="img-thumbnail rounded shadow-sm" style="max-width: 300px; max-height: 300px; object-fit: contain;">
                            <button type="button" id="removeImagePreview" class="btn btn-sm btn-danger rounded-pill mt-2">
                                <i class="fas fa-trash me-1"></i>Remove Image
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark btn-lg w-100 rounded-pill py-3 shadow fw-bold">
                        <i class="fas fa-paper-plane me-2"></i>Submit Review
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Share Modal -->
    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shareModalLabel">Share Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">Share this product with your friends!</p>
                    <div class="mb-3">
                        <label for="shareUrl" class="form-label">Product URL:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="shareUrl" value="{{ url()->current() }}" readonly>
                            <button class="btn btn-outline-secondary" type="button" id="copyShareUrl">Copy</button>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-primary">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($product->name) }}" target="_blank" class="btn btn-info text-white">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($product->name . ' - ' . url()->current()) }}" target="_blank" class="btn btn-success">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ask a Question Modal -->
    <div class="modal fade" id="askQuestionModal" tabindex="-1" aria-labelledby="askQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="askQuestionModalLabel">Ask a Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="questionForm">
                        @csrf
                        <input type="hidden" id="questionProductId" value="{{ $product->id }}">
                        <div class="mb-3">
                            <label for="questionName" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="questionName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="questionEmail" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="questionEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="questionText" class="form-label">Your Question</label>
                            <textarea class="form-control" id="questionText" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark">Submit Question</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Modal -->
    <div class="modal fade" id="faqModal" tabindex="-1" aria-labelledby="faqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="faqModalLabel">Frequently Asked Questions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    What materials are used in this product?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Our products are crafted from high-quality materials including sterling silver (S925), gold, and premium gemstones. Each product listing includes detailed material information.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    How long does shipping take?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We aim to deliver your order within 3–5 business days. All shipments are tracked and insured for your peace of mind.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    What is your return policy?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Returns are accepted within 14 days of delivery. Items must be unworn and in original packaging. Please contact our customer service team to initiate a return.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Do you offer international shipping?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, we ship worldwide! Shipping times may vary by location. Please check the shipping information in your cart for estimated delivery times to your country.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    How do I care for my jewelry?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    To maintain the beauty of your jewelry, store it in a dry place, avoid contact with chemicals, and clean gently with a soft cloth. Remove jewelry before swimming or showering.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        document.getElementById('cartErrorMessage').classList.add('d-none');
                        setTimeout(() => msg.classList.add('d-none'), 3000);
                    } else {
                        const errorMsg = document.getElementById('cartErrorMessage');
                        errorMsg.textContent = data.message || 'Failed to add product to cart.';
                        errorMsg.classList.remove('d-none');
                        document.getElementById('cartMessage').classList.add('d-none');
                        setTimeout(() => errorMsg.classList.add('d-none'), 5000);
                    }
                })
                .catch(err => {
                    console.error(err);
                    const errorMsg = document.getElementById('cartErrorMessage');
                    errorMsg.textContent = 'An error occurred. Please try again.';
                    errorMsg.classList.remove('d-none');
                    document.getElementById('cartMessage').classList.add('d-none');
                    setTimeout(() => errorMsg.classList.add('d-none'), 5000);
                });
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

        // View All Reviews Link - Open Reviews Tab and Scroll
        document.getElementById('viewAllReviewsLink')?.addEventListener('click', function(e) {
            e.preventDefault();
            const reviewsTab = document.getElementById('reviews-tab');
            if (reviewsTab) {
                const tab = new bootstrap.Tab(reviewsTab);
                tab.show();
                setTimeout(() => {
                    const reviewsSection = document.getElementById('reviews');
                    if (reviewsSection) {
                        reviewsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }, 100);
            }
        });

        // Copy Share URL
        document.getElementById('copyShareUrl')?.addEventListener('click', function() {
            const shareUrl = document.getElementById('shareUrl');
            shareUrl.select();
            shareUrl.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand('copy');
            this.textContent = 'Copied!';
            setTimeout(() => {
                this.textContent = 'Copy';
            }, 2000);
        });

        // Ask a Question Form
        document.getElementById('questionForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = {
                name: document.getElementById('questionName').value,
                email: document.getElementById('questionEmail').value,
                message: document.getElementById('questionText').value,
                product_id: document.getElementById('questionProductId').value,
                _token: '{{ csrf_token() }}'
            };

            fetch("{{ route('products.question.store', $product) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(formData)
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    alert(data.message);
                    const modal = bootstrap.Modal.getInstance(document.getElementById('askQuestionModal'));
                    modal.hide();
                    document.getElementById('questionForm').reset();
                } else {
                    alert('There was an error submitting your question. Please try again.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('There was an error submitting your question. Please try again.');
            });
        });

    </script>
@endsection
