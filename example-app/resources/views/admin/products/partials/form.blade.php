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

