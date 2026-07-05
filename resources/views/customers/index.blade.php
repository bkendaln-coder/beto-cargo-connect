<!DOCTYPE html>
<html>
<head>
    <title>Clients - Beto Cargo Connect</title>
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

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Beto Cargo Connect</h1>
            <p class="text-muted">Gestion des clients</p>
        </div>

        <a href="{{ route('customers.create') }}" class="btn btn-primary">
            + Ajouter un client
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            Liste des clients
        </div>

        <div class="card-body">

            <form method="GET" action="{{ route('customers.index') }}" class="mb-4">
                <div class="row g-2">
                    <div class="col-md-10">
                        <input type="text"
                               name="search"
                               value="{{ $search ?? '' }}"
                               class="form-control"
                               placeholder="Rechercher par nom, téléphone, email, ville ou pays">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            Rechercher
                        </button>
                    </div>
                </div>
            </form>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Ville</th>
                        <th>Pays</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->first_name }}</td>
                            <td>{{ $customer->last_name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->city }}</td>
                            <td>{{ $customer->country }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Aucun client enregistré.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    <br>

    <a href="{{ route('packages.index') }}" class="btn btn-outline-secondary">
        Voir les colis
    </a>

</div>

</body>
</html>