<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactInfo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $contactInfo = [
            'address' => ContactInfo::getValue('address', 'PO Box 1622 Bamboo Street West'),
            'email' => ContactInfo::getValue('email', 'support@domain.com'),
            'phone' => ContactInfo::getValue('phone', '(012)-345-67890'),
            'opening_hours' => ContactInfo::getValue('opening_hours', 'Our store has re-opened for shopping and exchanges every day from 11am to 7pm.'),
        ];

        return view('contactus', compact('contactInfo'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'message' => ['required', 'string'],
            'product_id' => ['nullable', 'integer', 'exists:products,id'],
            'product_url' => ['nullable', 'string', 'max:500'],
        ]);

        Contact::create($validated);

        return redirect()
            ->route('contactus')
            ->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }

    public function storeProductQuestion(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        $product = \App\Models\Product::findOrFail($validated['product_id']);
        $validated['product_url'] = route('products.show', $product);

        Contact::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your question! We will get back to you soon.',
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Thank you for your question! We will get back to you soon.');
    }
}
