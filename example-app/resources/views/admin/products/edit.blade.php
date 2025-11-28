@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Edit Product</h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.products.partials.form', ['product' => $product])

                <button type="submit" class="btn btn-dark">Update Product</button>
            </form>
        </div>
    </div>
@endsection

