<!DOCTYPE html>
<html>
<head>
    <title>Suivi colis - Beto Cargo Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="text-center mb-4">
        <h1>Beto Cargo Connect</h1>
        <p class="text-muted">
            Suivi public de colis - {{ $agency->name }}
        </p>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            Numéro de suivi : <strong>{{ $package->tracking_number }}</strong>
        </div>

        <div class="card-body">

            <h4 class="mb-3">Statut actuel</h4>

            @if($package->status == 'received')
                <span class="badge bg-warning text-dark fs-6">🟡 Reçu</span>
            @elseif($package->status == 'in_transit')
                <span class="badge bg-primary fs-6">🔵 En transit</span>
            @elseif($package->status == 'arrived')
                <span class="badge bg-info text-dark fs-6">🟠 Arrivé</span>
            @elseif($package->status == 'delivered')
                <span class="badge bg-success fs-6">🟢 Livré</span>
            @else
                <span class="badge bg-secondary fs-6">{{ $package->status }}</span>
            @endif

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Client :</strong> {{ $package->customer->first_name }} {{ $package->customer->last_name }}</p>
                    <p><strong>Description :</strong> {{ $package->description }}</p>
                    <p><strong>Poids :</strong> {{ $package->weight_kg }} kg</p>
                </div>

                <div class="col-md-6">
                    <p><strong>Transport :</strong>
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
                    </p>

                    <p><strong>Origine :</strong> {{ $package->origin_city }}</p>
                    <p><strong>Destination :</strong> {{ $package->destination_city }}</p>
                </div>
            </div>

        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
             Progression du colis
        </div>

        <div class="card-body">

          @php
            $steps = [
                'received' => [
                    'label' => 'Colis reçu',
                    'icon' => '📦',
                ],
                'in_transit' => [
                    'label' => 'En transit',
                    'icon' => '🚚',
                ],
                'arrived' => [
                    'label' => 'Arrivé à destination',
                    'icon' => '📍',
                ],
                'delivered' => [
                    'label' => 'Livré au destinataire',
                    'icon' => '✅',
                ],
            ];

            $statusOrder = array_keys($steps);
            $currentPosition = array_search($package->status, $statusOrder);
          @endphp

        <div class="list-group">

            @foreach($steps as $status => $step)

                @php
                    $stepPosition = array_search($status, $statusOrder);
                    $history = $package->statusHistory->firstWhere('status', $status);

                    $isCompleted = $currentPosition !== false
                        && $stepPosition <= $currentPosition;

                    $isCurrent = $package->status === $status;
                @endphp

                <div class="list-group-item py-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <span class="fs-4 me-2">
                                {{ $step['icon'] }}
                            </span>

                            <strong>
                                {{ $step['label'] }}
                            </strong>

                            @if($isCurrent)
                                <span class="badge bg-primary ms-2">
                                    Statut actuel
                                </span>
                            @endif
                        </div>

                        <div>
                            @if($isCompleted)
                                <span class="badge bg-success">
                                    Terminé
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    En attente
                                </span>
                            @endif
                        </div>

                    </div>

                    @if($history)
                        <small class="text-muted d-block mt-2">
                            {{ $history->created_at->format('d/m/Y à H:i') }}
                        </small>
                    @endif

                </div>

            @endforeach

        </div>

    </div>
</div>

    <div class="mt-4 text-center">

        <div class="card shadow-sm mt-4">
            <div class="card-header bg-secondary text-white">
                Historique du colis
            </div>

            <div class="card-body">

                @if($package->statusHistory->count())

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Commentaire</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($package->statusHistory as $history)
                                <tr>
                                    <td>{{ $history->created_at->format('d/m/Y H:i') }}</td>

                                    <td>
                                        @if($history->status == 'received')
                                            🟡 Reçu
                                        @elseif($history->status == 'in_transit')
                                            🔵 En transit
                                        @elseif($history->status == 'arrived')
                                            🟠 Arrivé
                                        @elseif($history->status == 'delivered')
                                            🟢 Livré
                                        @else
                                            {{ $history->status }}
                                        @endif
                                    </td>

                                    <td>{{ $history->comment }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @else

                    <p class="text-muted">
                        Aucun historique disponible pour le moment.
                    </p>

                @endif

            </div>
        </div>
        <p class="text-muted">
            Pour toute question, contactez Beto Cargo Connect.
        </p>
    </div>

</div>

</body>
</html>