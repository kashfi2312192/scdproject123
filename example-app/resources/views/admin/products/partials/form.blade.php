@csrf
<div class="row g-4">
    <div class="col-md-6">
        <label for="name" class="form-label fw-bold mb-2">
            <i class="fas fa-tag me-2 text-primary"></i>Product Name
        </label>
        <input type="text" class="form-control form-control-lg rounded-pill" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" placeholder="Enter product name" required>
    </div>

    <div class="col-md-6">
        <label for="price" class="form-label fw-bold mb-2">
            <i class="fas fa-dollar-sign me-2 text-primary"></i>Price (PKR)
        </label>
        <input type="number" step="0.01" class="form-control form-control-lg rounded-pill" id="price" name="price" value="{{ old('price', $product->price ?? '') }}" placeholder="0.00" required>
    </div>
</div>

<div class="mb-4">
    <label for="description" class="form-label fw-bold mb-2">
        <i class="fas fa-align-left me-2 text-primary"></i>Description
    </label>
    <textarea class="form-control rounded" id="description" name="description" rows="4" placeholder="Enter product description">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <label for="category_id" class="form-label fw-bold mb-2">
            <i class="fas fa-folder me-2 text-primary"></i>Category
        </label>
        <select class="form-select form-select-lg rounded-pill" id="category_id" name="category_id">
            <option value="">Select a Category</option>
            @foreach($categories ?? [] as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <small class="text-muted mt-2 d-block">
            <i class="fas fa-info-circle me-1"></i>Select the product category
        </small>
    </div>

    <div class="col-md-6">
        <label for="tags" class="form-label fw-bold mb-2">
            <i class="fas fa-tags me-2 text-primary"></i>Tags
        </label>
        <input type="text" class="form-control form-control-lg rounded-pill" id="tags" name="tags" value="{{ old('tags', is_array($product->tags ?? null) ? implode(', ', $product->tags) : ($product->tags ?? '')) }}" placeholder="e.g., Gold, Silver, Diamond">
        <small class="text-muted mt-2 d-block">
            <i class="fas fa-info-circle me-1"></i>Enter tags separated by commas
        </small>
    </div>
</div>

<div class="mb-4">
    <label for="image" class="form-label fw-bold mb-2">
        <i class="fas fa-image me-2 text-primary"></i>Product Image
    </label>
    <input type="file" class="form-control form-control-lg rounded-pill" id="image" name="image" accept="image/*">
    @if (!empty($product?->image))
        <div class="mt-3">
            <small class="text-muted d-block mb-2">Current image: {{ $product->image }}</small>
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded shadow-sm" style="max-width: 250px;">
        </div>
    @endif
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 bg-light p-3 rounded">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="is_in_stock" name="is_in_stock" value="1" {{ old('is_in_stock', $product->is_in_stock ?? true) ? 'checked' : '' }}>
                <label class="form-check-label fw-bold" for="is_in_stock">
                    <i class="fas fa-check-circle me-2 text-success"></i>In Stock
                </label>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <label for="discount_percentage" class="form-label fw-bold mb-2">
            <i class="fas fa-percent me-2 text-primary"></i>Discount Percentage
        </label>
        <input type="number" step="0.01" min="0" max="100" class="form-control form-control-lg rounded-pill" id="discount_percentage" name="discount_percentage" value="{{ old('discount_percentage', $product->discount_percentage ?? '') }}" placeholder="e.g., 15.50">
        <small class="text-muted mt-2 d-block">
            <i class="fas fa-info-circle me-1"></i>Enter discount percentage (0-100)
        </small>
    </div>
</div>

