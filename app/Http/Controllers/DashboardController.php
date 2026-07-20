<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Package;

class DashboardController extends Controller
{
    public function index()
    {
        if (
            auth()->check()
            && auth()->user()->role !== 'super_admin'
            && auth()->user()->agency
        ) {
            session([
                'agency_id' => auth()->user()->agency_id,
                'agency_name' => auth()->user()->agency->name,
            ]);
        }
        
        $agencyId = session('agency_id');

        $totalCustomers = Customer::where('agency_id', $agencyId)->count();
        $totalPackages = Package::where('agency_id', $agencyId)->count();

        $receivedPackages = Package::where('agency_id', $agencyId)->where('status', 'received')->count();
        $inTransitPackages = Package::where('agency_id', $agencyId)->where('status', 'in_transit')->count();
        $arrivedPackages = Package::where('agency_id', $agencyId)->where('status', 'arrived')->count();
        $deliveredPackages = Package::where('agency_id', $agencyId)->where('status', 'delivered')->count();

        return view('dashboard', compact(
            'totalCustomers',
            'totalPackages',
            'receivedPackages',
            'inTransitPackages',
            'arrivedPackages',
            'deliveredPackages'
        ));
    }
}