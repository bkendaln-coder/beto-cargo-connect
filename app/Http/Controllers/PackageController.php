<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Customer;
use App\Models\PackageStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PackageController extends Controller
{
    public function index(Request $request)
        {
            $search = $request->search;

            $packages = Package::with('customer')
                ->where('agency_id', session('agency_id'))

                ->when($search, function ($query) use ($search) {
                    $query->where(function ($searchQuery) use ($search) {
                        $searchQuery
                            ->where('tracking_number', 'like', "%{$search}%")
                            ->orWhere('origin_city', 'like', "%{$search}%")
                            ->orWhere('destination_city', 'like', "%{$search}%")
                            ->orWhereHas('customer', function ($customerQuery) use ($search) {
                                $customerQuery
                                    ->where('first_name', 'like', "%{$search}%")
                                    ->orWhere('last_name', 'like', "%{$search}%");
                            });
                    });
                })

                ->latest()

                ->get();

            return view('packages.index', compact('packages', 'search'));
        }

    public function create()
    {
        $customers = Customer::where('agency_id', session('agency_id'))
            ->orderBy('first_name')
            ->get();

        return view('packages.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => [
                'required',
                Rule::exists('customers', 'id')
                    ->where(fn ($query) => $query->where('agency_id', session('agency_id'))),
            ],
            'description' => 'required|string|max:255',
            'weight_kg' => 'nullable|numeric',
            'transport_mode' => 'required',
            'origin_city' => 'required',
            'destination_city' => 'required',
        ]);

        $lastPackage = Package::latest('id')->first();

        $nextNumber = $lastPackage
            ? $lastPackage->id + 1
            : 1;

        $trackingNumber =
            'BCC-' .
            date('Y') .
            '-' .
            str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

        $package = Package::create([
            'tracking_number' => $trackingNumber,
            'customer_id' => $validated['customer_id'],
            'agency_id' => session('agency_id'),
            'description' => $validated['description'],
            'weight_kg' => $validated['weight_kg'],
            'transport_mode' => $validated['transport_mode'],
            'origin_city' => $validated['origin_city'],
            'destination_city' => $validated['destination_city'],
            'status' => 'received',
        ]);

        PackageStatusHistory::create([
            'package_id' => $package->id,
            'status' => 'received',
            'comment' => 'Colis enregistré dans le système',
        ]);

        return redirect()
            ->route('packages.index')
            ->with('success', 'Colis créé avec succès.');
    }

    public function show(Package $package)
    {
        abort_if(
            $package->agency_id !== session('agency_id'),
            403,
            'Accès interdit.'
        );

        return view('packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        abort_if(
            $package->agency_id !== session('agency_id'),
            403,
            'Accès interdit.'
        );

        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {

        abort_if(
            $package->agency_id !== session('agency_id'),
            403,
            'Accès interdit.'
        );

        $request->validate([
            'status' => 'required'
        ]);

        $oldStatus = $package->status;

        $package->update([
            'status' => $request->status
        ]);

        if ($oldStatus !== $request->status) {
            PackageStatusHistory::create([
                'package_id' => $package->id,
                'status' => $request->status,
                'comment' => 'Statut mis à jour',
            ]);
        }

        return view('packages.update-success', compact('package'));
    }

    public function destroy(Package $package)
    {
        abort_if(
            $package->agency_id !== session('agency_id'),
            403,
            'Accès interdit.'
        );

        $package->delete();

        return redirect()
            ->route('packages.index')
            ->with('success', 'Colis supprimé avec succès.');
    }

    public function track(\App\Models\Agency $agency, $tracking_number)
    {
        $package = Package::with([
            'customer',
            'statusHistory'
        ])
        ->where('agency_id', $agency->id)
        ->where('tracking_number', $tracking_number)
        ->firstOrFail();

        return view('packages.track', compact('package', 'agency'));
    }

    public function trackForm(\App\Models\Agency $agency)
    {
        return view('packages.track-search', compact('agency'));
    }

    public function trackSearch(Request $request, \App\Models\Agency $agency)
    {
        $request->validate([
            'tracking_number' => 'required|string',
        ]);

        return redirect()->route('packages.track', [
            'agency' => $agency->slug,
            'tracking_number' => $request->tracking_number,
        ]);
    }


    public function receipt(Package $package)
    {
        abort_if(
            $package->agency_id !== session('agency_id'),
            403,
            'Accès interdit.'
        );

        $package->load('customer');

        return view('packages.receipt', compact('package'));
    }   

}
