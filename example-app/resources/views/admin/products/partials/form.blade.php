@csrf
<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="category_id" class="form-label">Category</label>
    <select class="form-select" id="category_id" name="category_id">
        <option value="">Select a Category</option>
        @foreach($categories ?? [] as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <small class="text-muted">Select the product category</small>
</div>

<div class="mb-3">
    <label for="tags" class="form-label">Tags</label>
    <input type="text" class="form-control" id="tags" name="tags" value="{{ old('tags', is_array($product->tags ?? null) ? implode(', ', $product->tags) : ($product->tags ?? '')) }}" placeholder="e.g., Gold, Silver, Diamond">
    <small class="text-muted">Enter tags separated by commas (e.g., Gold, Silver, Diamond)</small>
</div>

<div class="mb-3">
    <label for="price" class="form-label">Price (PKR)</label>
    <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control" id="image" name="image" accept="image/*">
    @if (!empty($product?->image))
        <small class="text-muted d-block mt-2">Current image: {{ $product->image }}</small>
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded mt-2" style="max-width: 200px;">
    @endif
</div>

<div class="mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="is_in_stock" name="is_in_stock" value="1" {{ old('is_in_stock', $product->is_in_stock ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_in_stock">In Stock</label>
    </div>
</div>

<div class="mb-3">
    <label for="discount_percentage" class="form-label">Discount Percentage</label>
    <input type="number" step="0.01" min="0" max="100" class="form-control" id="discount_percentage" name="discount_percentage" value="{{ old('discount_percentage', $product->discount_percentage ?? '') }}" placeholder="e.g., 15.50">
    <small class="text-muted">Enter discount percentage (0-100)</small>
</div>

