@extends('admin.layouts.app')

@section('title', 'Contact Information')

@section('content')
    <div class="mb-5">
        <span class="badge bg-dark text-white px-3 py-2 mb-3">Contact Information</span>
        <h1 class="fw-bold display-5 mb-2">Contact Information</h1>
        <p class="lead text-muted">Manage contact information displayed on the website.</p>
    </div>

    <div class="card border-0 shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4">Field</th>
                            <th>Value</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contactInfos as $contactInfo)
                            <tr>
                                <td class="fw-semibold text-capitalize ps-4">
                                    <i class="fas fa-info-circle me-2 text-primary"></i>{{ str_replace('_', ' ', $contactInfo->key) }}
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($contactInfo->value, 80) }}</td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.contact-infos.edit', $contactInfo) }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

