@extends('admin.layouts.app')

@section('title', 'Edit Contact Information')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
        <div class="mb-3 mb-md-0">
            <span class="badge bg-dark text-white px-3 py-2 mb-3">Edit Contact Info</span>
            <h1 class="fw-bold display-5 mb-2">Edit Contact Information</h1>
            <p class="lead text-muted">Update {{ str_replace('_', ' ', $contactInfo->key) }}.</p>
        </div>
        <a href="{{ route('admin.contact-infos.index') }}" class="btn btn-outline-dark rounded-pill px-4">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
    </div>

    <div class="card border-0 shadow">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('admin.contact-infos.update', $contactInfo) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="value" class="form-label fw-bold mb-2">
                        <i class="fas fa-edit me-2 text-primary"></i>{{ ucfirst(str_replace('_', ' ', $contactInfo->key)) }}
                    </label>
                    @if($contactInfo->key == 'opening_hours')
                        <textarea class="form-control rounded @error('value') is-invalid @enderror" id="value" name="value" rows="3" placeholder="Enter {{ str_replace('_', ' ', $contactInfo->key) }}" required>{{ old('value', $contactInfo->value) }}</textarea>
                    @else
                        <input type="text" class="form-control form-control-lg rounded-pill @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value', $contactInfo->value) }}" placeholder="Enter {{ str_replace('_', ' ', $contactInfo->key) }}" required>
                    @endif
                    @error('value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark btn-lg rounded-pill px-5 py-3 shadow">
                    <i class="fas fa-save me-2"></i>Update
                </button>
            </form>
        </div>
    </div>
@endsection

