@extends('layouts.layout')

@section('title', 'Policies & Customer Care - Emilliä')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-dark text-white px-3 py-2 mb-3">Policies & Information</span>
                <h1 class="fw-bold display-4 mb-3">Policies & Customer Care</h1>
                <p class="lead text-muted">Find all our policies and customer care information.</p>
            </div>

            <div class="row g-4">
                @if($policies->isNotEmpty())
                    <div class="col-12 col-md-6">
                        <div class="card border-0 shadow h-100">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="fw-bold mb-4">
                                    <i class="fas fa-file-contract me-2 text-primary"></i>Our Policies
                                </h3>
                                <ul class="list-unstyled">
                                    @foreach($policies as $policy)
                                        <li class="mb-3">
                                            <a href="{{ route('policy.show', $policy->slug) }}" class="text-decoration-none text-dark fw-semibold d-flex align-items-center p-3 bg-light rounded">
                                                <i class="fa-solid fa-file-lines me-3 text-primary fs-5"></i>
                                                <span>{{ $policy->title }}</span>
                                                <i class="fas fa-arrow-right ms-auto text-muted"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @if($customerCare->isNotEmpty())
                    <div class="col-12 col-md-6">
                        <div class="card border-0 shadow h-100">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="fw-bold mb-4">
                                    <i class="fas fa-headset me-2 text-primary"></i>Customer Care
                                </h3>
                                <ul class="list-unstyled">
                                    @foreach($customerCare as $policy)
                                        <li class="mb-3">
                                            <a href="{{ route('policy.show', $policy->slug) }}" class="text-decoration-none text-dark fw-semibold d-flex align-items-center p-3 bg-light rounded">
                                                <i class="fa-solid fa-headset me-3 text-primary fs-5"></i>
                                                <span>{{ $policy->title }}</span>
                                                <i class="fas fa-arrow-right ms-auto text-muted"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @if($policies->isEmpty() && $customerCare->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-file-alt fa-4x text-muted mb-3"></i>
                    <h4 class="fw-bold mb-2">No policies available</h4>
                    <p class="text-muted">Policies will be available soon.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

