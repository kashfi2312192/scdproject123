@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="mb-4">
        <span class="badge bg-dark text-white px-3 py-2 mb-3">Admin Dashboard</span>
        <h1 class="fw-bold display-5 mb-2">Dashboard</h1>
        <p class="lead text-muted">Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded p-3">
                                <i class="fas fa-box fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted text-uppercase small mb-1 fw-semibold">Total Products</p>
                            <h2 class="fw-bold mb-0">{{ $totalProducts }}</h2>
                            <a href="{{ route('admin.products.index') }}" class="text-decoration-none small">
                                Manage products <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8">
            <div class="card border-0 shadow h-100">
                <div class="card-header bg-dark text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-clock me-2"></i>Latest Products</h5>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-light btn-sm rounded-pill">
                            <i class="fas fa-plus me-1"></i>Add Product
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if($latestProducts->isEmpty())
                        <div class="text-center py-4">
                            <i class="fas fa-box fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-0">No products available.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestProducts as $product)
                                        <tr>
                                            <td class="fw-semibold">{{ $product->name }}</td>
                                            <td class="fw-bold">PKR {{ number_format($product->price, 2) }}</td>
                                            <td><small class="text-muted">{{ $product->created_at->format('M d, Y') }}</small></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

