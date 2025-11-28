@extends('admin.layouts.app')

@section('title', 'Add Product')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Add Product</h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @include('admin.products.partials.form', ['product' => null])

                <button type="submit" class="btn btn-dark">Create Product</button>
            </form>
        </div>
    </div>
@endsection

