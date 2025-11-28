<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PolicyController extends Controller
{
    public function index(): View
    {
        $policies = Policy::where(function($query) {
            $query->where('type', 'policy')->orWhereNull('type');
        })->get();
        $customerCare = Policy::where('type', 'customer_care')->get();

        return view('policy.index', compact('policies', 'customerCare'));
    }

    public function show(string $slug): View
    {
        $policy = Policy::where('slug', $slug)->firstOrFail();

        return view('policy.show', compact('policy'));
    }
}
