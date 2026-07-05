<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Beto Cargo Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            📦 Beto Cargo Connect
        </a>

        <div class="navbar-nav">
            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
            <a class="nav-link" href="{{ route('customers.index') }}">Clients</a>
            <a class="nav-link" href="{{ route('packages.index') }}">Colis</a>
            <a class="nav-link" href="{{ route('packages.create') }}">Ajouter colis</a>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <div class="mb-4">
        <h1>Beto Cargo Connect</h1>
        <p class="text-muted">Tableau de bord logistique Canada → RDC</p>
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

</body>
</html>