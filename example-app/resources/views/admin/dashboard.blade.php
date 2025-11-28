@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="row g-4">
        <div class="col-12 col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="text-muted text-uppercase small mb-1">Total Products</p>
                    <h2 class="fw-bold">{{ $totalProducts }}</h2>
                    <a href="{{ route('admin.products.index') }}" class="text-decoration-none">Manage products →</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Latest Products</h5>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-dark">Add product</a>
                    </div>
                    @if($latestProducts->isEmpty())
                        <p class="text-muted mb-0">No products available.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm align-middle">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestProducts as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>PKR {{ number_format($product->price, 2) }}</td>
                                            <td>{{ $product->created_at->format('M d, Y') }}</td>
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

