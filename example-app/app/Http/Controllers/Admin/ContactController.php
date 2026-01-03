<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $contacts = Contact::latest()->paginate(15);

        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact): View
    {
        return view('admin.contacts.show', compact('contact'));
    }

    public function reply(Request $request, Contact $contact): RedirectResponse
    {
        $validated = $request->validate([
            'reply' => ['required', 'string'],
        ]);

        $contact->update([
            'reply' => $validated['reply'],
            'replied_at' => now(),
        ]);

        return redirect()
            ->route('admin.contacts.show', $contact)
            ->with('status', 'Reply sent successfully.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('status', 'Contact message deleted successfully.');
    }
}
