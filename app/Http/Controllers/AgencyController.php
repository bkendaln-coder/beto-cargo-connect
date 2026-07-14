<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AgencyController extends Controller
{
    public function index(): View
    {
        $agencies = Agency::latest()->get();

        return view('agencies.index', compact('agencies'));
    }

    public function create(): View
    {
        return view('agencies.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Agency::create($validated);

        return redirect()->route('agencies.index')
            ->with('success', 'Agence ajoutée avec succès.');
    }

    public function show(Agency $agency): View
    {
        return view('agencies.show', compact('agency'));
    }

    public function show(Agency $agency): View
    {
        return view('agencies.edit', compact('agency'));
    }

    public function update(Request $request, Agency $agency): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $agency->update($validated);

        return redirect()->route('agencies.index')
            ->with('success', 'Agence modifiée avec succès.');
    }

    public function destroy(Agency $agency): RedirectResponse
    {
        $agency->delete();

        return redirect()->route('agencies.index')
            ->with('success', 'Agence supprimée avec succès.');
    }

    public function select(Agency $agency): RedirectResponse
    {
        abort_if(
            auth()->check() &&
            auth()->user()->agency_id !== $agency->id,
            403,
            'Vous ne pouvez pas accéder à cette agence.'
        );

        session([
            'agency_id' => $agency->id,
            'agency_name' => $agency->name,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Agence active : ' . $agency->name);
    }
}