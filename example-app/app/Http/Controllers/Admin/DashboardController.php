<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalProducts = Product::count();
        $latestProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalProducts', 'latestProducts'));
    }
}
