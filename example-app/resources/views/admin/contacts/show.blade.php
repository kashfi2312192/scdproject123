@extends('admin.layouts.app')

@section('title', 'Contact Message Details')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Contact Message</h2>
            <p class="text-muted mb-0">View contact form submission details.</p>
        </div>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary">Back to List</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-2 fw-semibold">Name:</div>
                <div class="col-md-10">{{ $contact->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 fw-semibold">Email:</div>
                <div class="col-md-10">
                    <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                </div>
            </div>
            @if($contact->phone)
            <div class="row mb-3">
                <div class="col-md-2 fw-semibold">Phone:</div>
                <div class="col-md-10">{{ $contact->phone }}</div>
            </div>
            @endif
            <div class="row mb-3">
                <div class="col-md-2 fw-semibold">Message:</div>
                <div class="col-md-10">{{ $contact->message }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 fw-semibold">Submitted:</div>
                <div class="col-md-10">{{ $contact->created_at->format('F d, Y \a\t g:i A') }}</div>
            </div>
            <hr>
            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Delete this contact message?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Delete Message</button>
            </form>
        </div>
    </div>
@endsection

