<!DOCTYPE html>
<html>
<head>
    <title>Modifier statut - Beto Cargo Connect</title>
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
        <h1>Modifier le statut</h1>
        <p class="text-muted">Mise à jour du suivi du colis</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            {{ $package->tracking_number }}
        </div>

        <div class="card-body">
            <p><strong>Client :</strong> {{ $package->customer->first_name }} {{ $package->customer->last_name }}</p>
            <p><strong>Description :</strong> {{ $package->description }}</p>

            <form method="POST" action="{{ route('packages.update', $package->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Statut</label>
                    <select name="status" class="form-select">
                        <option value="received" {{ $package->status == 'received' ? 'selected' : '' }}>🟡 Reçu</option>
                        <option value="in_transit" {{ $package->status == 'in_transit' ? 'selected' : '' }}>🔵 En transit</option>
                        <option value="arrived" {{ $package->status == 'arrived' ? 'selected' : '' }}>🟠 Arrivé</option>
                        <option value="delivered" {{ $package->status == 'delivered' ? 'selected' : '' }}>🟢 Livré</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">
                    Mettre à jour
                </button>

                <a href="{{ route('packages.index') }}" class="btn btn-outline-secondary">
                    Annuler
                </a>
            </form>
        </div>
    </div>

</div>

</body>
</html>