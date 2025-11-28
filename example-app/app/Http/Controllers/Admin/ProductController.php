<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
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
        return view('admin.products.create');
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

        Product::create($data);

        return redirect()
            ->route('admin.products.index')
            ->with('status', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', compact('product'));
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
