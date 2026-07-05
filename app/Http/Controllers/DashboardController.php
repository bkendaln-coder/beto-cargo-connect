<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Package;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::count();
        $totalPackages = Package::count();
        $receivedPackages = Package::where('status', 'received')->count();
        $inTransitPackages = Package::where('status', 'in_transit')->count();
        $arrivedPackages = Package::where('status', 'arrived')->count();
        $deliveredPackages = Package::where('status', 'delivered')->count();

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