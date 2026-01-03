<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Order;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $recentOrders = Order::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $totalOrders = Order::where('user_id', $user->id)->count();
        $pendingOrders = Order::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        // Get contact replies for this user
        $contactReplies = Contact::where('email', $user->email)
            ->whereNotNull('reply')
            ->latest('replied_at')
            ->get();

        return view('dashboard', compact('recentOrders', 'totalOrders', 'pendingOrders', 'contactReplies'));
    }
}

