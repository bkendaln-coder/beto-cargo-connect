<!DOCTYPE html>
<html>

<head>
    <title>Reçu de dépôt</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body">

            <div class="text-center mb-4">

                <h2>🚢 {{ $package->agency->name }}</h2>

                <h4>{{ $package->agency->city }} - {{ $package->agency->country }}</h4>

                <p>
                    Canada 🇨🇦 → RDC 🇨🇩
                </p>

                <hr>

                <h3>REÇU DE DÉPÔT</h3>

            </div>

            <table class="table">

                <tr>
                    <th width="35%">Numéro de suivi</th>
                    <td>{{ $package->tracking_number }}</td>
                </tr>

                <tr>
                    <th>Client</th>
                    <td>
                        {{ $package->customer->first_name }}
                        {{ $package->customer->last_name }}
                    </td>
                </tr>

                <tr>
                    <th>Description</th>
                    <td>{{ $package->description }}</td>
                </tr>

                <tr>
                    <th>Poids</th>
                    <td>{{ $package->weight_kg }} kg</td>
                </tr>

                <tr>
                    <th>Transport</th>
                    <td>{{ $package->transport_mode }}</td>
                </tr>

                <tr>
                    <th>Origine</th>
                    <td>{{ $package->origin_city }}</td>
                </tr>

                <tr>
                    <th>Destination</th>
                    <td>{{ $package->destination_city }}</td>
                </tr>

                <tr>
                    <th>Date de dépôt</th>
                    <td>{{ $package->created_at->format('d/m/Y H:i') }}</td>
                </tr>

            </table>

            <div class="text-center mt-5">

                <p>
                    Merci d'avoir choisi
                    <strong>{{ $package->agency->name }}</strong>
                </p>

                <p class="text-muted">
                    Conservez ce reçu pour le suivi de votre colis.
                </p>

            </div>

            <div class="text-center mt-4 no-print">

                <button
                    onclick="window.print()"
                    class="btn btn-success">

                    🖨️ Imprimer

                </button>

                <a href="{{ route('packages.index') }}"
                   class="btn btn-secondary">

                    Retour

                </a>

            </div>

        </div>

    </div>

</div>

</body>

</html>