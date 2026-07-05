<!DOCTYPE html>
<html>
<head>
    <title>Colis - Beto Cargo Connect</title>
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
            <h1 class="mb-0">Beto Cargo Connect</h1>
            <p class="text-muted">Gestion des colis Canada → RDC</p>
        </div>

        <a href="{{ route('packages.create') }}" class="btn btn-primary">
            + Ajouter un colis
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            Liste des colis
        </div>

        <div class="card-body">

            <form method="GET" action="{{ route('packages.index') }}" class="mb-4">
                <div class="row g-2">
                    <div class="col-md-10">
                        <input type="text"
                            name="search"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            placeholder="Rechercher par tracking, client, origine ou destination">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            Rechercher
                        </button>
                    </div>
                </div>
            </form>

            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>Tracking</th>
                        <th>Client</th>
                        <th>Description</th>
                        <th>Poids</th>
                        <th>Transport</th>
                        <th>Origine</th>
                        <th>Destination</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($packages as $package)
                        <tr>
                            <td>
                                <strong>{{ $package->tracking_number }}</strong><br>
                                <a href="{{ route('packages.track', $package->tracking_number) }}" target="_blank">
                                    Suivi public
                                </a>
                            </td>

                            <td>
                                {{ $package->customer->first_name }}
                                {{ $package->customer->last_name }}
                            </td>

                            <td>{{ $package->description }}</td>
                            <td>{{ $package->weight_kg }} kg</td>

                            <td>
                                @if($package->transport_mode == 'air')
                                    ✈️ Fret aérien
                                @elseif($package->transport_mode == 'sea_groupage')
                                    🚢 Maritime groupage
                                @elseif($package->transport_mode == 'full_container')
                                    📦 Conteneur complet
                                @elseif($package->transport_mode == 'local_delivery')
                                    🚚 Livraison locale
                                @else
                                    {{ $package->transport_mode }}
                                @endif
                            </td>

                            <td>{{ $package->origin_city }}</td>
                            <td>{{ $package->destination_city }}</td>

                            <td>
                                @if($package->status == 'received')
                                    <span class="badge bg-warning text-dark">🟡 Reçu</span>
                                @elseif($package->status == 'in_transit')
                                    <span class="badge bg-primary">🔵 En transit</span>
                                @elseif($package->status == 'arrived')
                                    <span class="badge bg-info text-dark">🟠 Arrivé</span>
                                @elseif($package->status == 'delivered')
                                    <span class="badge bg-success">🟢 Livré</span>
                                @else
                                    <span class="badge bg-secondary">{{ $package->status }}</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-sm btn-outline-primary">
                                    Modifier
                                </a>

                                <a href="{{ route('packages.receipt', $package->id) }}"
                                    class="btn btn-success btn-sm">

                                    Reçu

                                </a>

                                <a
                                    href="https://wa.me/?text={{ urlencode(
                                        'Bonjour ' .
                                        $package->customer->first_name .
                                        ', votre colis ' .
                                        $package->tracking_number .
                                        ' a été enregistré chez T.L.S. (Toronto Line Shipping).' .
                                        "\n\nSuivi : " .
                                        route('packages.track', $package->tracking_number)
                                    ) }}"
                                    target="_blank"
                                    class="btn btn-success btn-sm">

                                    WhatsApp

                                </a>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                Aucun colis enregistré.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <br>

    <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
        Voir les clients
    </a>

</div>

</body>
</html>