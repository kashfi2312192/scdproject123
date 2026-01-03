@extends('layouts.layout')

@section('title', $policy->title . ' - Emilliä')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow">
                        <div class="card-body p-4 p-md-5">
                            <div class="mb-4">
                                <a href="{{ route('policies.index') }}" class="btn btn-outline-dark rounded-pill mb-3">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Policies
                                </a>
                            </div>
                            <div class="text-center mb-4">
                                <span class="badge bg-dark text-white px-3 py-2 mb-3">Policy</span>
                                <h1 class="fw-bold display-4 mb-3">{{ $policy->title }}</h1>
                            </div>
                            <div class="policy-content lead text-muted" style="line-height: 1.8;">
                                {!! nl2br(e($policy->content)) !!}
                            </div>
                            <div class="mt-5 text-center">
                                <a href="{{ route('homepage') }}" class="btn btn-dark btn-lg rounded-pill px-5 py-3">
                                    <i class="fas fa-home me-2"></i>Back to Home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

