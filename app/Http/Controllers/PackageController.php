<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Customer;
use App\Models\PackageStatusHistory;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
        {
            $search = $request->search;

            $packages = Package::with('customer')

                ->when($search, function ($query) use ($search) {

                    $query->where('tracking_number', 'like', "%{$search}%")

                        ->orWhere('origin_city', 'like', "%{$search}%")

                        ->orWhere('destination_city', 'like', "%{$search}%")

                        ->orWhereHas('customer', function ($customer) use ($search) {

                                $customer->where('first_name', 'like', "%{$search}%")
                                         ->orWhere('last_name', 'like', "%{$search}%");

                        });

                })

                ->latest()

                ->get();

            return view('packages.index', compact('packages', 'search'));
        }

    public function create()
    {
        $customers = Customer::orderBy('first_name')->get();

        return view('packages.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
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
        //
    }

    public function edit(Package $package)
    {
        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
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

        return redirect()
            ->route('packages.index')
            ->with('success', 'Statut mis à jour avec succès.');
    }

    public function destroy(Package $package)
    {
        //
    }

    public function track($tracking_number)
    {
        $package = Package::with([
            'customer',
            'statusHistory'
        ])
        ->where('tracking_number', $tracking_number)
        ->firstOrFail();

        return view('packages.track', compact('package'));
    }

    public function trackForm()
    {
        return view('packages.track-search');
    }

    public function trackSearch(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string'
    ]);

    return redirect()->route('packages.track', $request->tracking_number);
    }

    public function receipt(Package $package)
    {
        $package->load('customer');

        return view('packages.receipt', compact('package'));
    }

}
