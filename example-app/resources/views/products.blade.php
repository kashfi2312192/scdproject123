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

        

            <!-- Ajax Search Bar -->
            <div class="row g-3 align-items-end mb-4">
                <div class="col-12 col-md-4 position-relative">
                    <label class="form-label fw-semibold d-md-none">Search</label>
                    <input
                        type="text"
                        id="ajaxSearchInput"
                        class="form-control rounded-pill"
                        placeholder="🔍 Search by product name..."
                        autocomplete="off">
                    <div id="searchResultsDropdown" class="dropdown-menu w-100 mt-1 shadow" style="display: none; max-height: 400px; overflow-y: auto; position: absolute; z-index: 1000; top: 100%; left: 0;">
                        <div id="searchResultsContent"></div>
                    </div>
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
                    <select name="material" id="materialSelect" class="form-select rounded-pill">
                        <option value="">All Materials</option>
                        <option value="Gold" {{ request('material')=='Gold' ? 'selected' : '' }}>Gold</option>
                        <option value="Silver" {{ request('material')=='Silver' ? 'selected' : '' }}>Silver</option>
                        <option value="Diamond" {{ request('material')=='Diamond' ? 'selected' : '' }}>Diamond</option>
                        <option value="Pearl" {{ request('material')=='Pearl' ? 'selected' : '' }}>Pearl</option>
                    </select>
                </div>

                <div class="col-6 col-md-2">
                    <label class="form-label fw-semibold d-md-none">Style</label>
                    <select name="style" id="styleSelect" class="form-select rounded-pill">
                        <option value="">All Styles</option>
                        <option value="Classic" {{ request('style')=='Classic' ? 'selected' : '' }}>Classic</option>
                        <option value="Modern" {{ request('style')=='Modern' ? 'selected' : '' }}>Modern</option>
                        <option value="Minimalist" {{ request('style')=='Minimalist' ? 'selected' : '' }}>Minimalist</option>
                        <option value="Boho" {{ request('style')=='Boho' ? 'selected' : '' }}>Boho</option>
                    </select>
                </div>

                <div class="col-6 col-md-2 text-md-end">
                    <form method="GET" action="{{ route('products') }}" class="d-inline w-100" id="filterForm">
                        <input type="hidden" name="query" id="searchQueryInput" value="{{ request('query') }}">
                        <input type="hidden" name="category" id="searchCategoryInput" value="{{ request('category') }}">
                        <input type="hidden" name="material" id="searchMaterialInput" value="{{ request('material') }}">
                        <input type="hidden" name="style" id="searchStyleInput" value="{{ request('style') }}">
                        <button type="submit" class="btn btn-dark rounded-pill w-100">Filter</button>
                    </form>
                </div>
            </div>

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

    <script>
        (function() {
            const searchInput = document.getElementById('ajaxSearchInput');
            const dropdown = document.getElementById('searchResultsDropdown');
            const resultsContent = document.getElementById('searchResultsContent');
            const searchQueryInput = document.getElementById('searchQueryInput');
            const searchCategoryInput = document.getElementById('searchCategoryInput');
            let searchTimeout;

            // Set initial values if coming from filtered results
            if (searchQueryInput.value) {
                searchInput.value = searchQueryInput.value;
            }

            // Update hidden inputs when material/style change
            const materialSelect = document.getElementById('materialSelect');
            const styleSelect = document.getElementById('styleSelect');
            const searchMaterialInput = document.getElementById('searchMaterialInput');
            const searchStyleInput = document.getElementById('searchStyleInput');

            if (materialSelect) {
                materialSelect.addEventListener('change', function() {
                    searchMaterialInput.value = this.value;
                });
            }
            if (styleSelect) {
                styleSelect.addEventListener('change', function() {
                    searchStyleInput.value = this.value;
                });
            }

            function performSearch() {
                clearTimeout(searchTimeout);
                const query = searchInput.value.trim();
                
                // Update hidden inputs for filter button
                searchQueryInput.value = query;

                // Hide dropdown if query is empty
                if (query.length === 0) {
                    dropdown.style.display = 'none';
                    return;
                }

                // Debounce the search (reduced to 200ms for faster response)
                searchTimeout = setTimeout(() => {
                    const category = document.querySelector('select[name="category"]')?.value || '';
                    searchCategoryInput.value = category;

                    // Only search if query hasn't changed (debounce check)
                    const currentQuery = searchInput.value.trim();
                    if (currentQuery !== query) {
                        return; // Query changed during debounce, skip this request
                    }

                    fetch(`{{ route('products.search.ajax') }}?q=${encodeURIComponent(query)}&category=${encodeURIComponent(category)}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Search request failed');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Double-check query hasn't changed since request started
                        if (searchInput.value.trim() !== query) {
                            return;
                        }

                        if (data.length === 0) {
                            resultsContent.innerHTML = '<div class="dropdown-item-text text-muted p-3">No products found</div>';
                        } else {
                            resultsContent.innerHTML = data.map(product => `
                                <a href="${product.url}" class="dropdown-item d-flex align-items-center gap-3 p-3" onclick="document.getElementById('searchResultsDropdown').style.display='none';">
                                    <img src="${product.image_url}" alt="${product.name}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold">${product.name}</div>
                                        <small class="text-muted">${product.category} • PKR ${parseFloat(product.price).toLocaleString('en-PK', {minimumFractionDigits: 2})}</small>
                                    </div>
                                </a>
                            `).join('');
                        }
                        dropdown.style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                        resultsContent.innerHTML = '<div class="dropdown-item-text text-danger p-3">Error searching products</div>';
                        dropdown.style.display = 'block';
                    });
                }, 200);
            }

            // Search on input event (fires on every change - typing, pasting, etc.)
            searchInput.addEventListener('input', performSearch);

            // Also search when category changes
            const categorySelect = document.querySelector('select[name="category"]');
            if (categorySelect) {
                categorySelect.addEventListener('change', function() {
                    if (searchInput.value.trim().length > 0) {
                        performSearch();
                    }
                });
            }

            // Hide dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.style.display = 'none';
                }
            });

            // Hide dropdown on escape key
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    dropdown.style.display = 'none';
                }
            });
        })();
    </script>
@endsection


