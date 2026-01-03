<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::latest()->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($imagePath = $this->handleImageUpload($request)) {
            $data['image'] = $imagePath;
        }

        if (($data['description'] ?? null) === '') {
            $data['description'] = null;
        }

        $data['is_in_stock'] = $request->has('is_in_stock') ? (bool) $request->input('is_in_stock') : false;
        $data['discount_percentage'] = $request->filled('discount_percentage') ? $request->input('discount_percentage') : null;
        
        // Handle tags - convert comma-separated string to array
        if ($request->filled('tags')) {
            $tags = array_map('trim', explode(',', $request->input('tags')));
            $tags = array_filter($tags); // Remove empty values
            $data['tags'] = !empty($tags) ? $tags : null;
        } else {
            $data['tags'] = null;
        }
        
        // Handle category_id - set to null if empty
        if (!$request->filled('category_id')) {
            $data['category_id'] = null;
        }

        // Generate slug from name if not provided
        if (empty($data['slug'] ?? null)) {
            $baseSlug = Str::slug($data['name']);
            $slug = $baseSlug;
            $counter = 1;
            
            // Ensure slug is unique
            while (Product::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $data['slug'] = $slug;
        }

        Product::create($data);

        return redirect()
            ->route('admin.products.index')
            ->with('status', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();

        if ($imagePath = $this->handleImageUpload($request, $product)) {
            $data['image'] = $imagePath;
        }

        if (($data['description'] ?? null) === '') {
            $data['description'] = null;
        }

        $data['is_in_stock'] = $request->has('is_in_stock') ? (bool) $request->input('is_in_stock') : false;
        $data['discount_percentage'] = $request->filled('discount_percentage') ? $request->input('discount_percentage') : null;
        
        // Handle tags - convert comma-separated string to array
        if ($request->filled('tags')) {
            $tags = array_map('trim', explode(',', $request->input('tags')));
            $tags = array_filter($tags); // Remove empty values
            $data['tags'] = !empty($tags) ? $tags : null;
        } else {
            $data['tags'] = null;
        }
        
        // Handle category_id - set to null if empty
        if (!$request->filled('category_id')) {
            $data['category_id'] = null;
        }

        // Generate slug from name if name changed and slug not provided
        if (isset($data['name']) && $product->name !== $data['name'] && empty($data['slug'] ?? null)) {
            $baseSlug = Str::slug($data['name']);
            $slug = $baseSlug;
            $counter = 1;
            
            // Ensure slug is unique (excluding current product)
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $data['slug'] = $slug;
        }

        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('status', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->deleteStoredImage($product);
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('status', 'Product deleted successfully.');
    }

    private function handleImageUpload(StoreProductRequest|UpdateProductRequest $request, ?Product $product = null): ?string
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        if ($product) {
            $this->deleteStoredImage($product);
        }

        return $request->file('image')->store('products', 'public');
    }

    private function deleteStoredImage(Product $product): void
    {
        if ($product->image && !Str::startsWith($product->image, 'img/')) {
            Storage::disk('public')->delete($product->image);
        }
    }
}
