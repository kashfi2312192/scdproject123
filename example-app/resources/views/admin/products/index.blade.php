@extends('admin.layouts.app')

@section('title', 'Manage Products')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Products</h2>
            <p class="text-muted mb-0">Manage all products in the catalog.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-dark">
            <i class="fa-solid fa-plus me-2"></i> Add Product
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($products->isEmpty())
                <p class="mb-0 text-muted">No products found.</p>
            @else
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Created</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="fw-semibold">{{ $product->name }}</td>
                                    <td>PKR {{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->created_at->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-secondary me-2">Edit</a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div>
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection

