@extends('admin.layouts.app')

@section('title', 'Edit Contact Information')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Edit Contact Information</h2>
            <p class="text-muted mb-0">Update {{ str_replace('_', ' ', $contactInfo->key) }}.</p>
        </div>
        <a href="{{ route('admin.contact-infos.index') }}" class="btn btn-outline-secondary">Back to List</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.contact-infos.update', $contactInfo) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="value" class="form-label">{{ ucfirst(str_replace('_', ' ', $contactInfo->key)) }}</label>
                    @if($contactInfo->key == 'opening_hours')
                        <textarea class="form-control @error('value') is-invalid @enderror" id="value" name="value" rows="3" required>{{ old('value', $contactInfo->value) }}</textarea>
                    @else
                        <input type="text" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value', $contactInfo->value) }}" required>
                    @endif
                    @error('value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark">Update</button>
            </form>
        </div>
    </div>
@endsection

