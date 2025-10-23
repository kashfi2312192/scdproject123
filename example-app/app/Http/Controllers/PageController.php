<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Add this method
    public function home()
    {
        return view('homepage');
    }
}
