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
                            <form action="#" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">Your Name</label>
                                    <input type="text" class="form-control rounded-3" id="name" placeholder="Enter your full name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Your Email</label>
                                    <input type="email" class="form-control rounded-3" id="email" placeholder="example@email.com" required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label fw-semibold">Phone Number</label>
                                    <input type="text" class="form-control rounded-3" id="phone" placeholder="(012)-345-67890">
                                </div>

                                <div class="mb-3">
                                    <label for="message" class="form-label fw-semibold">Your Message</label>
                                    <textarea class="form-control rounded-3" id="message" rows="5" placeholder="Write your message here..." required></textarea>
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
                                    PO Box 1622 Bamboo Street West
                                </li>
                                <li class="mb-3">
                                    <strong>Email:</strong><br>
                                    <a href="mailto:Emillia@example.com" class="text-decoration-none text-dark">support@domain.com</a>
                                </li>
                                <li class="mb-3">
                                    <strong>Call Us:</strong><br>
                                    (012)-345-67890
                                </li>
                                <li class="mb-3">
                                    <strong>Opening Time:</strong><br>
                                    Our store has re-opened for shopping and exchanges every day from 11am to 7pm.
                                </li>
                            </ul>
                            <a href="mailto:support@domain.com" class="btn btn-outline-dark w-100 rounded-pill">
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
