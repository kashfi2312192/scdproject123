@extends('admin.layouts.app')

@section('title', 'Contact Information')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Contact Information</h2>
            <p class="text-muted mb-0">Manage contact information displayed on the website.</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contactInfos as $contactInfo)
                            <tr>
                                <td class="fw-semibold text-capitalize">{{ str_replace('_', ' ', $contactInfo->key) }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($contactInfo->value, 80) }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.contact-infos.edit', $contactInfo) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

