<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-light">
<div class="d-flex min-vh-100">
    <aside class="bg-dark text-white p-4 d-flex flex-column shadow" style="width: 250px;">
        <div class="mb-4">
            <h4 class="fw-bold mb-0"><i class="fas fa-shield-alt me-2"></i>Admin Panel</h4>
        </div>
        <nav class="nav flex-column gap-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white rounded px-3 py-2 {{ request()->routeIs('admin.dashboard') ? 'bg-white bg-opacity-25 fw-bold' : 'text-opacity-75' }}">
                <i class="fa-solid fa-gauge me-2"></i> Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}" class="nav-link text-white rounded px-3 py-2 {{ request()->routeIs('admin.products.*') ? 'bg-white bg-opacity-25 fw-bold' : 'text-opacity-75' }}">
                <i class="fa-solid fa-boxes-stacked me-2"></i> Products
            </a>
            <a href="{{ route('admin.contacts.index') }}" class="nav-link text-white rounded px-3 py-2 {{ request()->routeIs('admin.contacts.*') ? 'bg-white bg-opacity-25 fw-bold' : 'text-opacity-75' }}">
                <i class="fa-solid fa-envelope me-2"></i> Contacts
            </a>
            <a href="{{ route('admin.orders.index') }}" class="nav-link text-white rounded px-3 py-2 {{ request()->routeIs('admin.orders.*') ? 'bg-white bg-opacity-25 fw-bold' : 'text-opacity-75' }}">
                <i class="fa-solid fa-shopping-cart me-2"></i> Orders
            </a>
            <a href="{{ route('admin.policies.index') }}" class="nav-link text-white rounded px-3 py-2 {{ request()->routeIs('admin.policies.*') ? 'bg-white bg-opacity-25 fw-bold' : 'text-opacity-75' }}">
                <i class="fa-solid fa-file-lines me-2"></i> Policies
            </a>
            <a href="{{ route('admin.contact-infos.index') }}" class="nav-link text-white rounded px-3 py-2 {{ request()->routeIs('admin.contact-infos.*') ? 'bg-white bg-opacity-25 fw-bold' : 'text-opacity-75' }}">
                <i class="fa-solid fa-address-card me-2"></i> Contact Info
            </a>
        </nav>
        <div class="mt-auto pt-4 border-top border-white border-opacity-25">
            <p class="small text-opacity-75 mb-1">Signed in as</p>
            <strong><i class="fas fa-user me-2"></i>{{ auth()->user()->name ?? 'Admin' }}</strong>
        </div>
    </aside>
    <div class="flex-grow-1 d-flex flex-column">
        <nav class="bg-white border-bottom shadow-sm py-3 px-4 d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('homepage') }}" class="btn btn-outline-dark rounded-pill">
                    <i class="fas fa-home me-2"></i>Back to Site
                </a>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger rounded-pill">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </button>
            </form>
        </nav>
        <main class="flex-grow-1 p-4 bg-light">
            @if (session('status'))
                <div class="alert alert-success rounded shadow-sm mb-4">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger rounded shadow-sm mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>

