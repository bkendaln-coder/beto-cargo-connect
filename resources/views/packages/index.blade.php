@extends('layouts.agency')

@section('title', 'Colis')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-1">Colis</h1>
        <p class="text-muted mb-0">
            Gestion des colis
        </p>
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
                    <input
                        type="text"
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

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
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

                                <a
                                    href="{{ route('packages.track', [
                                        'agency' => $package->agency->slug,
                                        'tracking_number' => $package->tracking_number,
                                    ]) }}"
                                    target="_blank">
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
                                    <span class="badge bg-secondary">
                                        {{ $package->status }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex flex-wrap gap-2">
                                    <a
                                        href="{{ route('packages.edit', $package) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        Modifier
                                    </a>

                                    <a
                                        href="{{ route('packages.receipt', $package) }}"
                                        class="btn btn-sm btn-success">
                                        Reçu
                                    </a>

                                    <a
                                        href="https://wa.me/?text={{ urlencode(
                                            'Bonjour ' .
                                            $package->customer->first_name .
                                            ', votre colis ' .
                                            $package->tracking_number .
                                            ' a été enregistré chez ' .
                                            $package->agency->name .
                                            '.' .
                                            "\n\nSuivi : " .
                                            route('packages.track', [
                                                'agency' => $package->agency->slug,
                                                'tracking_number' => $package->tracking_number,
                                            ])
                                        ) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-success">
                                        WhatsApp
                                    </a>
                                </div>
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
</div>

<div class="mt-4">
    <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
        Voir les clients
    </a>
</div>

@endsection