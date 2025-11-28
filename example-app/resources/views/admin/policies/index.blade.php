@extends('admin.layouts.app')

@section('title', 'Manage Policies')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Policies</h2>
            <p class="text-muted mb-0">Manage policy and customer care pages.</p>
        </div>
        <a href="{{ route('admin.policies.create') }}" class="btn btn-dark">
            <i class="fa-solid fa-plus me-2"></i> Add Policy
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($policies->isEmpty())
                <p class="mb-0 text-muted">No policies found.</p>
            @else
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Slug</th>
                                <th>Updated</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($policies as $policy)
                                <tr>
                                    <td class="fw-semibold">{{ $policy->title }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $policy->type ?? 'N/A' }}</span>
                                    </td>
                                    <td><code>{{ $policy->slug }}</code></td>
                                    <td>{{ $policy->updated_at->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.policies.edit', $policy) }}" class="btn btn-sm btn-outline-secondary me-2">Edit</a>
                                        <form action="{{ route('admin.policies.destroy', $policy) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this policy?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div>
                    {{ $policies->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection

