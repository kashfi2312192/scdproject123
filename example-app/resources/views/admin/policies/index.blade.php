@extends('admin.layouts.app')

@section('title', 'Manage Policies')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
        <div class="mb-3 mb-md-0">
            <span class="badge bg-dark text-white px-3 py-2 mb-3">Policy Management</span>
            <h1 class="fw-bold display-5 mb-2">Policies</h1>
            <p class="lead text-muted">Manage policy and customer care pages.</p>
        </div>
        <a href="{{ route('admin.policies.create') }}" class="btn btn-dark btn-lg rounded-pill px-5">
            <i class="fa-solid fa-plus me-2"></i>Add Policy
        </a>
    </div>

    <div class="card border-0 shadow">
        <div class="card-body p-0">
            @if($policies->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-file-alt fa-4x text-muted mb-3"></i>
                    <h4 class="fw-bold mb-2">No policies found</h4>
                    <p class="text-muted mb-4">Start by creating your first policy!</p>
                    <a href="{{ route('admin.policies.create') }}" class="btn btn-dark btn-lg rounded-pill px-5">
                        <i class="fas fa-plus me-2"></i>Add Policy
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4">Title</th>
                                <th>Type</th>
                                <th>Slug</th>
                                <th>Updated</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($policies as $policy)
                                <tr>
                                    <td class="fw-semibold ps-4">{{ $policy->title }}</td>
                                    <td>
                                        <span class="badge bg-secondary rounded-pill px-3 py-2">{{ $policy->type ?? 'N/A' }}</span>
                                    </td>
                                    <td><code class="bg-light px-2 py-1 rounded">{{ $policy->slug }}</code></td>
                                    <td><small class="text-muted">{{ $policy->updated_at->format('M d, Y') }}</small></td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin.policies.edit', $policy) }}" class="btn btn-sm btn-outline-secondary rounded-pill me-2">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <form action="{{ route('admin.policies.destroy', $policy) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this policy?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-4">
                    {{ $policies->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection

