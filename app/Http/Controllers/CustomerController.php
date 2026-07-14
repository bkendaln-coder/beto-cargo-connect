<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $customers = Customer::where('agency_id', session('agency_id'))
            ->when($search, function ($query) use ($search) {
                $query->where(function ($searchQuery) use ($search) {
                    $searchQuery
                        ->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('city', 'like', "%{$search}%")
                        ->orWhere('country', 'like', "%{$search}%");
                });
            })
        ->latest()
        ->get();

        return view('customers.index', compact('customers', 'search'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        $validated['agency_id'] = session('agency_id');
        
        Customer::create($validated);

        return redirect()->route('customers.index')
            ->with('success', 'Client ajouté avec succès.');
    }

    public function show(Customer $customer)
    {
        abort_if(
            $customer->agency_id !== session('agency_id'),
            403,
            'Accès interdit.'
        );

        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        abort_if(
            $customer->agency_id !== session('agency_id'),
            403,
            'Accès interdit.'
        );

        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        abort_if(
            $customer->agency_id !== session('agency_id'),
            403,
            'Accès interdit.'
        );

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')
            ->with('success', 'Client modifié avec succès.');
    }

    public function destroy(Customer $customer)
    {
        abort_if(
            $customer->agency_id !== session('agency_id'),
            403,
            'Accès interdit.'
        );

        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Client supprimé avec succès.');
    }
}
