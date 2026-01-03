<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderHistoryController extends Controller
{
    public function index(): View
    {
        $orders = auth()->user()->orders()->with('user')->latest()->paginate(10);

        return view('order-history', compact('orders'));
    }

    public function show($id): View
    {
        $order = auth()->user()->orders()->findOrFail($id);

        return view('order-details', compact('order'));
    }
}
