@extends('layouts.layout')

@section('title', $policy->title . ' - Emilliä')

@section('content')
    <section class="py-5 bg-light" style="margin-top: 5rem;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-5">
                            <h1 class="fw-bold mb-4">{{ $policy->title }}</h1>
                            <div class="policy-content">
                                {!! nl2br(e($policy->content)) !!}
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('homepage') }}" class="btn btn-outline-dark">Back to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

