<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactInfoController extends Controller
{
    public function index(): View
    {
        $contactInfos = ContactInfo::orderBy('key')->get();
        
        // Ensure all required keys exist
        $requiredKeys = ['address', 'email', 'phone', 'opening_hours'];
        foreach ($requiredKeys as $key) {
            if (!ContactInfo::where('key', $key)->exists()) {
                ContactInfo::create(['key' => $key, 'value' => '']);
            }
        }
        
        $contactInfos = ContactInfo::orderBy('key')->get();

        return view('admin.contact-infos.index', compact('contactInfos'));
    }

    public function edit(ContactInfo $contactInfo): View
    {
        return view('admin.contact-infos.edit', compact('contactInfo'));
    }

    public function update(Request $request, ContactInfo $contactInfo): RedirectResponse
    {
        $validated = $request->validate([
            'value' => ['required', 'string'],
        ]);

        $contactInfo->update($validated);

        return redirect()
            ->route('admin.contact-infos.index')
            ->with('status', 'Contact information updated successfully.');
    }
}
