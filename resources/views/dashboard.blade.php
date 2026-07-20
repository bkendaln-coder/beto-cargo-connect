@extends('layouts.agency')

@section('title', session('agency_name'))

@section('content')

<div class="container mt-5">

    <div class="page-header mb-4">

        <h1 class="display-6 fw-bold mb-1">
            {{ session('agency_name') }}
        </h1>

        <p class="text-secondary mb-2">
            Cargo Management Portal
        </p>

        @if(session('agency_website'))
            <a href="{{ session('agency_website') }}"
                target="_blank"
                class="btn btn-outline-primary btn-sm">
                🌐 Visiter le site web
            </a>
        @endif

    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Clients</h6>
                    <h2>{{ $totalCustomers }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Colis</h6>
                    <h2>{{ $totalPackages }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-warning">
                <div class="card-body">
                    <h6 class="text-muted">Reçus</h6>
                    <h2 class="text-warning">{{ $receivedPackages }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-primary">
                <div class="card-body">
                    <h6 class="text-muted">En transit</h6>
                    <h2 class="text-primary">{{ $inTransitPackages }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-info">
                <div class="card-body">
                    <h6 class="text-muted">Arrivés</h6>
                    <h2 class="text-info">{{ $arrivedPackages }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-success">
                <div class="card-body">
                    <h6 class="text-muted">Livrés</h6>
                    <h2 class="text-success">{{ $deliveredPackages }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-4">
        <a href="{{ route('customers.index') }}" class="btn btn-primary">
            Clients
        </a>

        <a href="{{ route('packages.index') }}" class="btn btn-success">
            Colis
        </a>
    </div>

</div>

@endsection