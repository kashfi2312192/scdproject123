@extends('admin.layouts.app')

@section('title', 'Manage Products')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
        <div class="mb-3 mb-md-0">
            <span class="badge bg-dark text-white px-3 py-2 mb-3">Manage Products</span>
            <h1 class="fw-bold display-5 mb-2">Products</h1>
            <p class="lead text-muted">Manage all products in the catalog.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-dark btn-lg rounded-pill px-5">
            <i class="fa-solid fa-plus me-2"></i>Add Product
        </a>
    </div>

    <div class="card border-0 shadow">
        <div class="card-body p-0">
            @if($products->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-box fa-4x text-muted mb-3"></i>
                    <h4 class="fw-bold mb-2">No products found</h4>
                    <p class="text-muted mb-4">Start by adding your first product!</p>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-dark btn-lg rounded-pill px-5">
                        <i class="fas fa-plus me-2"></i>Add Product
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4">Name</th>
                                <th>Price</th>
                                <th>In Stock</th>
                                <th>Discount %</th>
                                <th>Created</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="fw-semibold ps-4">{{ $product->name }}</td>
                                    <td class="fw-bold">PKR {{ number_format($product->price, 2) }}</td>
                                    <td>
                                        <span class="badge rounded-pill {{ $product->is_in_stock ? 'bg-success' : 'bg-danger' }}">
                                            {{ $product->is_in_stock ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($product->discount_percentage)
                                            <span class="badge bg-warning text-dark">{{ number_format($product->discount_percentage, 2) }}%</span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td><small class="text-muted">{{ $product->created_at->format('M d, Y') }}</small></td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary rounded-pill me-2" target="_blank" title="View Product">
                                            <i class="fa-solid fa-eye me-1"></i>View
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-secondary rounded-pill me-2">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-4">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection

