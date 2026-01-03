@extends('admin.layouts.app')

@section('title', 'Contact Message Details')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
        <div class="mb-3 mb-md-0">
            <span class="badge bg-dark text-white px-3 py-2 mb-3">Contact Details</span>
            <h1 class="fw-bold display-5 mb-2">Contact Message</h1>
            <p class="lead text-muted">View contact form submission details.</p>
        </div>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-dark rounded-pill px-4">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
    </div>

    <div class="card border-0 shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0 fw-bold"><i class="fas fa-user me-2"></i>Customer Information</h5>
        </div>
        <div class="card-body p-4">
            <div class="row mb-4">
                <div class="col-md-3 fw-bold mb-2 mb-md-0"><i class="fas fa-user me-2 text-primary"></i>Name:</div>
                <div class="col-md-9">{{ $contact->name }}</div>
            </div>
            <div class="row mb-4">
                <div class="col-md-3 fw-bold mb-2 mb-md-0"><i class="fas fa-envelope me-2 text-primary"></i>Email:</div>
                <div class="col-md-9">
                    <a href="mailto:{{ $contact->email }}" class="text-decoration-none">{{ $contact->email }}</a>
                </div>
            </div>
            @if($contact->phone)
            <div class="row mb-4">
                <div class="col-md-3 fw-bold mb-2 mb-md-0"><i class="fas fa-phone me-2 text-primary"></i>Phone:</div>
                <div class="col-md-9">{{ $contact->phone }}</div>
            </div>
            @endif
            <div class="row mb-4">
                <div class="col-md-3 fw-bold mb-2 mb-md-0"><i class="fas fa-comment me-2 text-primary"></i>Message:</div>
                <div class="col-md-9">
                    <div class="bg-light p-3 rounded">{{ $contact->message }}</div>
                </div>
            </div>
            @if($contact->product_url)
            <div class="row mb-4">
                <div class="col-md-3 fw-bold mb-2 mb-md-0"><i class="fas fa-box me-2 text-primary"></i>Product:</div>
                <div class="col-md-9">
                    <a href="{{ $contact->product_url }}" target="_blank" class="btn btn-outline-primary rounded-pill">
                        <i class="fas fa-external-link-alt me-1"></i>View Product
                    </a>
                </div>
            </div>
            @endif
            <div class="row mb-4">
                <div class="col-md-3 fw-bold mb-2 mb-md-0"><i class="fas fa-calendar me-2 text-primary"></i>Submitted:</div>
                <div class="col-md-9"><small class="text-muted">{{ $contact->created_at->format('F d, Y \a\t g:i A') }}</small></div>
            </div>
        </div>
    </div>

    @if($contact->reply)
    <div class="card border-0 shadow mt-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0 fw-bold"><i class="fas fa-reply me-2"></i>Your Reply</h5>
        </div>
        <div class="card-body p-4">
            <div class="alert alert-success rounded mb-3">
                {{ $contact->reply }}
            </div>
            <small class="text-muted">
                <i class="fas fa-clock me-1"></i>Replied on: {{ $contact->replied_at->format('F d, Y \a\t g:i A') }}
            </small>
        </div>
    </div>
    @endif

    <div class="card border-0 shadow mt-4">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0 fw-bold"><i class="fas fa-paper-plane me-2"></i>Reply to Customer</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.contacts.reply', $contact) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="reply" class="form-label fw-bold">Your Reply</label>
                    <textarea class="form-control rounded" id="reply" name="reply" rows="5" placeholder="Type your reply here..." required>{{ old('reply', $contact->reply) }}</textarea>
                    @error('reply')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark btn-lg rounded-pill px-5">
                    <i class="fas fa-paper-plane me-2"></i>Send Reply
                </button>
            </form>
        </div>
    </div>

    <div class="mt-4">
        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Delete this contact message?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger rounded-pill px-4">
                <i class="fas fa-trash me-2"></i>Delete Message
            </button>
        </form>
    </div>
@endsection

