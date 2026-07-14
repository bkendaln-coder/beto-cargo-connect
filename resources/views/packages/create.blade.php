<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un colis - Beto Cargo Connect</title>
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
        <h1>Ajouter un colis</h1>
        <p class="text-muted">
            Créer un nouveau colis pour {{ session('agency_name') }}
        </p>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Informations du colis
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('packages.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Client</label>
                    <select name="customer_id" class="form-select" required>
                        <option value="">-- Choisir un client --</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">
                                {{ $customer->first_name }} {{ $customer->last_name }} - {{ $customer->phone }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description du colis</label>
                    <input type="text" name="description" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Poids KG</label>
                    <input type="number" step="0.01" name="weight_kg" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mode de transport</label>
                    <select name="transport_mode" class="form-select" required>
                        <option value="air">✈️ Fret aérien</option>
                        <option value="sea_groupage">🚢 Maritime - Groupage</option>
                        <option value="full_container">📦 Conteneur complet</option>
                        <option value="local_delivery">🚚 Livraison locale</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ville d'origine</label>
                    <input type="text" name="origin_city" value="Toronto" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ville destination</label>
                    <input type="text" name="destination_city" value="Kinshasa" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">
                    Enregistrer le colis
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