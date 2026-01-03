@extends('admin.layouts.app')

@section('title', 'Add Product')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
        <div class="mb-3 mb-md-0">
            <span class="badge bg-dark text-white px-3 py-2 mb-3">Add Product</span>
            <h1 class="fw-bold display-5 mb-2">Add Product</h1>
            <p class="lead text-muted">Create a new product for your catalog.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark rounded-pill px-4">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
    </div>

    <div class="card border-0 shadow">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @include('admin.products.partials.form', ['product' => null])

                <div class="mt-4">
                    <button type="submit" class="btn btn-dark btn-lg rounded-pill px-5 py-3 shadow">
                        <i class="fas fa-plus me-2"></i>Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

