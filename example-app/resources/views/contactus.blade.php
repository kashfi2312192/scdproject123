@extends('layouts.layout')

@section('title', 'Emilliä - Contact Us')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <!-- Title -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <span class="badge bg-dark text-white px-3 py-2 mb-3">Contact Us</span>
                    <h1 class="fw-bold display-4 mb-3">Get in Touch</h1>
                    <p class="lead text-muted mb-0">
                        Please enter the details of your request. A member of our support staff will respond as soon as possible.
                    </p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body p-4 p-md-5">
                            @if(session('success'))
                                <div class="alert alert-success rounded">{{ session('success') }}</div>
                            @endif

                            <form action="{{ route('contactus.store') }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label for="name" class="form-label fw-bold"><i class="fas fa-user me-2 text-primary"></i>Your Name</label>
                                    <input type="text" class="form-control form-control-lg rounded-pill @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter your full name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="form-label fw-bold"><i class="fas fa-envelope me-2 text-primary"></i>Your Email</label>
                                    <input type="email" class="form-control form-control-lg rounded-pill @error('email') is-invalid @enderror" id="email" name="email" placeholder="example@email.com" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="phone" class="form-label fw-bold"><i class="fas fa-phone me-2 text-primary"></i>Phone Number</label>
                                    <input type="text" class="form-control form-control-lg rounded-pill @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="(012)-345-67890" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="message" class="form-label fw-bold"><i class="fas fa-comment me-2 text-primary"></i>Your Message</label>
                                    <textarea class="form-control rounded @error('message') is-invalid @enderror" id="message" name="message" rows="5" placeholder="Write your message here..." required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-dark btn-lg w-100 rounded-pill py-3 shadow">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body p-4 p-md-5">
                            <h4 class="fw-bold mb-4"><i class="fas fa-info-circle me-2 text-primary"></i>Contact Information</h4>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-4 p-3 bg-light rounded">
                                    <div class="d-flex align-items-start">
                                        <i class="fas fa-map-marker-alt text-primary me-3 mt-1 fs-5"></i>
                                        <div>
                                            <strong class="d-block mb-1">Address</strong>
                                            {{ $contactInfo['address'] }}
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-4 p-3 bg-light rounded">
                                    <div class="d-flex align-items-start">
                                        <i class="fas fa-envelope text-primary me-3 mt-1 fs-5"></i>
                                        <div>
                                            <strong class="d-block mb-1">Email</strong>
                                            <a href="mailto:{{ $contactInfo['email'] }}" class="text-decoration-none text-dark">{{ $contactInfo['email'] }}</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-4 p-3 bg-light rounded">
                                    <div class="d-flex align-items-start">
                                        <i class="fas fa-phone text-primary me-3 mt-1 fs-5"></i>
                                        <div>
                                            <strong class="d-block mb-1">Call Us</strong>
                                            {{ $contactInfo['phone'] }}
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-4 p-3 bg-light rounded">
                                    <div class="d-flex align-items-start">
                                        <i class="fas fa-clock text-primary me-3 mt-1 fs-5"></i>
                                        <div>
                                            <strong class="d-block mb-1">Opening Time</strong>
                                            {{ $contactInfo['opening_hours'] }}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <a href="mailto:{{ $contactInfo['email'] }}" class="btn btn-outline-dark btn-lg w-100 rounded-pill py-3">
                                <i class="fas fa-envelope me-2"></i>Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
