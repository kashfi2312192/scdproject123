@extends('layouts.layout')

@section('title', 'Policies & Customer Care - Emilliä')

@section('content')
    <section class="py-5 bg-light" style="margin-top: 5rem;">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="fw-bold">Policies & Customer Care</h1>
                <p class="text-muted">Find all our policies and customer care information.</p>
            </div>

            <div class="row g-4">
                @if($policies->isNotEmpty())
                    <div class="col-12 col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <h3 class="fw-bold mb-4">Our Policies</h3>
                                <ul class="list-unstyled">
                                    @foreach($policies as $policy)
                                        <li class="mb-3">
                                            <a href="{{ route('policy.show', $policy->slug) }}" class="text-decoration-none text-dark fw-semibold">
                                                <i class="fa-solid fa-file-lines me-2"></i>{{ $policy->title }}
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
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <h3 class="fw-bold mb-4">Customer Care</h3>
                                <ul class="list-unstyled">
                                    @foreach($customerCare as $policy)
                                        <li class="mb-3">
                                            <a href="{{ route('policy.show', $policy->slug) }}" class="text-decoration-none text-dark fw-semibold">
                                                <i class="fa-solid fa-headset me-2"></i>{{ $policy->title }}
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
                    <p class="text-muted">No policies available at the moment.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

