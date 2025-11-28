<?php

namespace App\Http\Controllers;

use App\Models\Product;

class PageController extends Controller
{
    public function home()
    {
        $featuredProducts = Product::latest()->take(8)->get();

        return view('homepage', compact('featuredProducts'));
    }
}
