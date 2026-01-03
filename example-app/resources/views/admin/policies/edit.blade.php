@extends('admin.layouts.app')

@section('title', 'Edit Policy')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
        <div class="mb-3 mb-md-0">
            <span class="badge bg-dark text-white px-3 py-2 mb-3">Edit Policy</span>
            <h1 class="fw-bold display-5 mb-2">Edit Policy</h1>
            <p class="lead text-muted">Update policy content.</p>
        </div>
        <a href="{{ route('admin.policies.index') }}" class="btn btn-outline-dark rounded-pill px-4">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
    </div>

    <div class="card border-0 shadow">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('admin.policies.update', $policy) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="form-label fw-bold mb-2">
                        <i class="fas fa-heading me-2 text-primary"></i>Title
                    </label>
                    <input type="text" class="form-control form-control-lg rounded-pill @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $policy->title) }}" placeholder="Enter policy title" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="type" class="form-label fw-bold mb-2">
                        <i class="fas fa-list me-2 text-primary"></i>Type
                    </label>
                    <select class="form-select form-select-lg rounded-pill @error('type') is-invalid @enderror" id="type" name="type">
                        <option value="">Select Type</option>
                        <option value="policy" {{ old('type', $policy->type) == 'policy' ? 'selected' : '' }}>Our Policies</option>
                        <option value="customer_care" {{ old('type', $policy->type) == 'customer_care' ? 'selected' : '' }}>Customer Care</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="content" class="form-label fw-bold mb-2">
                        <i class="fas fa-file-alt me-2 text-primary"></i>Content
                    </label>
                    <textarea class="form-control rounded @error('content') is-invalid @enderror" id="content" name="content" rows="10" placeholder="Enter policy content..." required>{{ old('content', $policy->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark btn-lg rounded-pill px-5 py-3 shadow">
                    <i class="fas fa-save me-2"></i>Update Policy
                </button>
            </form>
        </div>
    </div>
@endsection

