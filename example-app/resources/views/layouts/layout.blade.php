<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Emilliä - Home')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body class="bg-white text-dark">
<!-- ===== Navbar ===== -->
<header>
    <nav class="navbar navbar-expand-lg fixed-top bg-dark bg-opacity-75 navbar-dark shadow-sm">
        <div class="container">

            <!-- Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('homepage') }}">
                <img src="{{ asset('img/logo.webp') }}" alt="Emilliä Logo" height="40">
            </a>



            <!-- Links -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav text-uppercase fw-semibold">
                    <li class="nav-item">
                        <a href="{{ route('homepage') }}" class="nav-link {{ request()->routeIs('homepage') ? 'active' : '' }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products') }}" class="nav-link {{ request()->routeIs('products') ? 'active' : '' }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contactus') }}" class="nav-link {{ request()->routeIs('contactus') ? 'active' : '' }}">Contact</a>
                    </li>
                </ul>
            </div>

            <!-- Icons -->
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('cart.index') }}" class="text-white position-relative">
                    <i class="fas fa-shopping-cart"></i>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ count(session('cart')) }}
        </span>
                    @endif
                </a>

                @auth
                    <div class="dropdown">
                        <button class="btn btn-link text-white text-decoration-none dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            @if(auth()->user()->is_admin)
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-light btn-sm">Sign Up</a>
                @endauth
            </div>
        </div>
    </nav>
</header>

<!-- ===== Page Content ===== -->
<main style="padding-top: 76px;">
    @yield('content')
</main>

<!-- ===== Footer ===== -->
<footer class="bg-light mt-5 border-top pt-5">
    <div class="container">
        <div class="row g-4 text-center text-md-start">
            <div class="col-12 col-md-3">
                <h5 class="fw-bold mb-3"><i class="fas fa-map-marker-alt me-2"></i>Contact Us</h5>
                @php
                    $contactInfo = [
                        'address' => \App\Models\ContactInfo::getValue('address', 'PO Box 1622 Bamboo Street West'),
                        'phone' => \App\Models\ContactInfo::getValue('phone', '+(123)-456-7890'),
                        'email' => \App\Models\ContactInfo::getValue('email', 'Emillia@example.com'),
                        'opening_hours' => \App\Models\ContactInfo::getValue('opening_hours', '9:00AM - 10:00PM'),
                    ];
                @endphp
                <p class="mb-2"><i class="fas fa-map-marker-alt me-2 text-muted"></i>{{ $contactInfo['address'] }}</p>
                <p class="mb-2"><i class="fas fa-phone me-2 text-muted"></i><a href="tel:{{ $contactInfo['phone'] }}" class="text-decoration-none text-dark">{{ $contactInfo['phone'] }}</a></p>
                <p class="mb-2"><i class="fas fa-envelope me-2 text-muted"></i><a href="mailto:{{ $contactInfo['email'] }}" class="text-decoration-none text-dark">{{ $contactInfo['email'] }}</a></p>
                <p class="mb-0"><i class="fas fa-clock me-2 text-muted"></i>{{ $contactInfo['opening_hours'] }}</p>
            </div>

            <div class="col-6 col-md-3">
                <h5 class="fw-bold mb-3"><i class="fas fa-file-contract me-2"></i>Our Policies</h5>
                <ul class="list-unstyled">
                    @php
                        $policies = \App\Models\Policy::where(function($query) {
                            $query->where('type', 'policy')->orWhereNull('type');
                        })->get();
                    @endphp
                    @forelse($policies as $policy)
                        <li class="mb-2"><a href="{{ route('policy.show', $policy->slug) }}" class="text-decoration-none text-dark"><i class="fas fa-chevron-right me-2 small text-muted"></i>{{ $policy->title }}</a></li>
                    @empty
                        <li class="mb-2"><a href="#" class="text-decoration-none text-dark"><i class="fas fa-chevron-right me-2 small text-muted"></i>Shipping & Delivery</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-dark"><i class="fas fa-chevron-right me-2 small text-muted"></i>Returns Policy</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-dark"><i class="fas fa-chevron-right me-2 small text-muted"></i>Terms & Conditions</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-dark"><i class="fas fa-chevron-right me-2 small text-muted"></i>Privacy Policy</a></li>
                    @endforelse
                </ul>
            </div>

            <div class="col-6 col-md-3">
                <h5 class="fw-bold mb-3"><i class="fas fa-headset me-2"></i>Customer Care</h5>
                <ul class="list-unstyled">
                    @php
                        $customerCare = \App\Models\Policy::where('type', 'customer_care')->get();
                    @endphp
                    @forelse($customerCare as $policy)
                        <li class="mb-2"><a href="{{ route('policy.show', $policy->slug) }}" class="text-decoration-none text-dark"><i class="fas fa-chevron-right me-2 small text-muted"></i>{{ $policy->title }}</a></li>
                    @empty
                        <li class="mb-2"><a href="#" class="text-decoration-none text-dark"><i class="fas fa-chevron-right me-2 small text-muted"></i>FAQs</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-dark"><i class="fas fa-chevron-right me-2 small text-muted"></i>Terms of Service</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-dark"><i class="fas fa-chevron-right me-2 small text-muted"></i>Privacy Policy</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-dark"><i class="fas fa-chevron-right me-2 small text-muted"></i>Gift Card</a></li>
                    @endforelse
                </ul>
            </div>

            <div class="col-12 col-md-3">
                <h5 class="fw-bold mb-3">Thank You For Choosing Us!</h5>
                <p>We appreciate your support and are dedicated to providing you with the best products and service.</p>
            </div>
        </div>

        <hr class="my-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-center text-md-start">
            <div class="mb-3 mb-md-0">
                <p class="fw-semibold mb-1">We Accept Payments</p>
                <img src="{{ asset('img/payment.avif') }}" alt="Payments" height="30">
            </div>

            <div class="text-center mb-3 mb-md-0">
                <img src="{{ asset('img/Logo-black.avif') }}" alt="Logo" height="40" class="mb-2">
                <p class="m-0">&copy; 2025 Nova Creative. All Rights Reserved.</p>
            </div>

            <div>
                <p class="fw-semibold mb-1">Follow Us</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#" class="text-dark"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-dark"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-dark"><i class="fab fa-x-twitter"></i></a>
                    <a href="#" class="text-dark"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="text-dark"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
