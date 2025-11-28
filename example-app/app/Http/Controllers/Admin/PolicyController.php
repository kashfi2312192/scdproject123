<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PolicyController extends Controller
{
    public function index(): View
    {
        $policies = Policy::latest()->paginate(15);

        return view('admin.policies.index', compact('policies'));
    }

    public function create(): View
    {
        return view('admin.policies.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'type' => ['nullable', 'string', 'in:policy,customer_care'],
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        Policy::create($validated);

        return redirect()
            ->route('admin.policies.index')
            ->with('status', 'Policy created successfully.');
    }

    public function show(Policy $policy): View
    {
        return view('admin.policies.show', compact('policy'));
    }

    public function edit(Policy $policy): View
    {
        return view('admin.policies.edit', compact('policy'));
    }

    public function update(Request $request, Policy $policy): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'type' => ['nullable', 'string', 'in:policy,customer_care'],
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $policy->update($validated);

        return redirect()
            ->route('admin.policies.index')
            ->with('status', 'Policy updated successfully.');
    }

    public function destroy(Policy $policy): RedirectResponse
    {
        $policy->delete();

        return redirect()
            ->route('admin.policies.index')
            ->with('status', 'Policy deleted successfully.');
    }
}
