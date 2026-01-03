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
                        <a href="#reviews" class="text-decoration-none ms-2" id="viewAllReviewsLink">VIEW ALL REVIEWS</a>
                    </p>

                    <div class="d-flex align-items-baseline gap-3 mb-3 flex-wrap">
                        <h4 class="fw-bold text-dark mb-0">PKR {{ number_format($product->price, 2) }}</h4>
                    </div>

                    <p class="text-secondary small">{{ $product->description ?? 'No description available.' }}</p>

                    <p class="text-danger fw-semibold small mb-1">
                        Ships worldwide in 3–5 business days.
                    </p>

                    <p class="mb-1 small">
                        <strong>Available:</strong> 
                        @if($product->is_in_stock)
                            <span class="text-success">In stock</span>
                        @else
                            <span class="text-danger">Out of stock</span>
                        @endif
                    </p>
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
                        <button class="btn btn-dark rounded-pill px-4" id="addToCartBtn" {{ !$product->is_in_stock ? 'disabled' : '' }}>{{ $product->is_in_stock ? 'Add to Cart' : 'Out of Stock' }}</button>
                        <button class="btn btn-outline-dark rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#shareModal">Share</button>
                        <button class="btn btn-outline-dark rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#askQuestionModal">Ask a Question</button>
                        <button class="btn btn-outline-dark rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#faqModal">FAQ</button>
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
                                            <img src="{{ $review->image_url }}" alt="Review image" class="img-thumbnail" style="max-width: 250px; max-height: 250px; object-fit: cover; width: 250px; height: 250px;">
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
