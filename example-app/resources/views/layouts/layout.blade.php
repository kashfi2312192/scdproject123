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
                    <li class="nav-item">
                        <a href="{{ url('/admin') }}" class="nav-link">Admin</a>
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

            </div>
        </div>
    </nav>
</header>

<!-- ===== Page Content ===== -->
<main >
    @yield('content')
</main>

<!-- ===== Footer ===== -->
<footer class="bg-light mt-5 border-top pt-5">
    <div class="container">
        <div class="row g-4 text-center text-md-start">
            <div class="col-12 col-md-3">
                <h5 class="fw-bold mb-3">Contact Us</h5>
                @php
                    $contactInfo = [
                        'address' => \App\Models\ContactInfo::getValue('address', 'PO Box 1622 Bamboo Street West'),
                        'phone' => \App\Models\ContactInfo::getValue('phone', '+(123)-456-7890'),
                        'email' => \App\Models\ContactInfo::getValue('email', 'Emillia@example.com'),
                        'opening_hours' => \App\Models\ContactInfo::getValue('opening_hours', '9:00AM - 10:00PM'),
                    ];
                @endphp
                <p class="mb-1">📍 {{ $contactInfo['address'] }}</p>
                <p class="mb-1">📞 {{ $contactInfo['phone'] }}</p>
                <p class="mb-1">📧 {{ $contactInfo['email'] }}</p>
                <p>🕘 {{ $contactInfo['opening_hours'] }}</p>
            </div>

            <div class="col-6 col-md-3">
                <h5 class="fw-bold mb-3">Our Policies</h5>
                <ul class="list-unstyled">
                    @php
                        $policies = \App\Models\Policy::where(function($query) {
                            $query->where('type', 'policy')->orWhereNull('type');
                        })->get();
                    @endphp
                    @forelse($policies as $policy)
                        <li><a href="{{ route('policy.show', $policy->slug) }}" class="text-decoration-none text-dark">{{ $policy->title }}</a></li>
                    @empty
                        <li><a href="#" class="text-decoration-none text-dark">Shipping & Delivery</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Returns Policy</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Terms & Conditions</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Privacy Policy</a></li>
                    @endforelse
                </ul>
            </div>

            <div class="col-6 col-md-3">
                <h5 class="fw-bold mb-3">Customer Care</h5>
                <ul class="list-unstyled">
                    @php
                        $customerCare = \App\Models\Policy::where('type', 'customer_care')->get();
                    @endphp
                    @forelse($customerCare as $policy)
                        <li><a href="{{ route('policy.show', $policy->slug) }}" class="text-decoration-none text-dark">{{ $policy->title }}</a></li>
                    @empty
                        <li><a href="#" class="text-decoration-none text-dark">FAQs</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Terms of Service</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Privacy Policy</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Gift Card</a></li>
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
