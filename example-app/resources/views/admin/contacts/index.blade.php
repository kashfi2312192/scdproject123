@extends('admin.layouts.app')

@section('title', 'Contact Messages')

@section('content')
    <div class="mb-5">
        <span class="badge bg-dark text-white px-3 py-2 mb-3">Contact Management</span>
        <h1 class="fw-bold display-5 mb-2">Contact Messages</h1>
        <p class="lead text-muted">View and manage contact form submissions.</p>
    </div>

    <div class="card border-0 shadow">
        <div class="card-body p-0">
            @if($contacts->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-envelope fa-4x text-muted mb-3"></i>
                    <h4 class="fw-bold mb-2">No contact messages found</h4>
                    <p class="text-muted">Contact messages will appear here.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4">Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Product</th>
                                <th>Date</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td class="fw-semibold ps-4">{{ $contact->name }}</td>
                                    <td><a href="mailto:{{ $contact->email }}" class="text-decoration-none">{{ $contact->email }}</a></td>
                                    <td>{{ $contact->phone ?? '<span class="text-muted">N/A</span>' }}</td>
                                    <td><small>{{ \Illuminate\Support\Str::limit($contact->message, 50) }}</small></td>
                                    <td>
                                        @if($contact->product_url)
                                            <a href="{{ $contact->product_url }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill">
                                                <i class="fas fa-external-link-alt me-1"></i>View Product
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td><small class="text-muted">{{ $contact->created_at->format('M d, Y') }}</small></td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-outline-secondary rounded-pill me-2">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this contact message?')">
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
                    {{ $contacts->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection

