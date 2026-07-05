<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un client - Beto Cargo Connect</title>
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
        <h1>Ajouter un client</h1>
        <p class="text-muted">Créer un nouveau client dans Beto Cargo Connect</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Informations du client
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('customers.store') }}">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text"
                               name="first_name"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text"
                               name="last_name"
                               class="form-control"
                               required>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="text"
                               name="phone"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control">
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">Adresse</label>
                    <textarea name="address"
                              class="form-control"
                              rows="3"></textarea>
                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ville</label>
                        <input type="text"
                               name="city"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pays</label>
                        <input type="text"
                               name="country"
                               value="Canada"
                               class="form-control">
                    </div>

                </div>

                <button type="submit" class="btn btn-success">
                    Enregistrer le client
                </button>

                <a href="{{ route('customers.index') }}"
                   class="btn btn-outline-secondary">
                    Annuler
                </a>

            </form>

        </div>
    </div>

</div>

</body>
</html>