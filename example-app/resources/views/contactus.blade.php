@extends('layouts.layout')

@section('title', 'Emilliä - Contact Us')

@section('content')
    <br><br><br>

    <section class="py-5 bg-light">
        <div class="container">
            <!-- Title -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h1 class="fw-bold mb-3">Get in Touch</h1>
                    <p class="text-muted mb-0">
                        Please enter the details of your request. A member of our support staff will respond as soon as possible.
                    </p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form action="{{ route('contactus.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">Your Name</label>
                                    <input type="text" class="form-control rounded-3 @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter your full name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Your Email</label>
                                    <input type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" id="email" name="email" placeholder="example@email.com" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label fw-semibold">Phone Number</label>
                                    <input type="text" class="form-control rounded-3 @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="(012)-345-67890" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="message" class="form-label fw-semibold">Your Message</label>
                                    <textarea class="form-control rounded-3 @error('message') is-invalid @enderror" id="message" name="message" rows="5" placeholder="Write your message here..." required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-dark w-100 rounded-pill py-2">
                                    Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-4">Contact Information</h4>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3">
                                    <strong>Address:</strong><br>
                                    {{ $contactInfo['address'] }}
                                </li>
                                <li class="mb-3">
                                    <strong>Email:</strong><br>
                                    <a href="mailto:{{ $contactInfo['email'] }}" class="text-decoration-none text-dark">{{ $contactInfo['email'] }}</a>
                                </li>
                                <li class="mb-3">
                                    <strong>Call Us:</strong><br>
                                    {{ $contactInfo['phone'] }}
                                </li>
                                <li class="mb-3">
                                    <strong>Opening Time:</strong><br>
                                    {{ $contactInfo['opening_hours'] }}
                                </li>
                            </ul>
                            <a href="mailto:{{ $contactInfo['email'] }}" class="btn btn-outline-dark w-100 rounded-pill">
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
