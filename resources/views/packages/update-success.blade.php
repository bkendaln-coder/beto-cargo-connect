<!DOCTYPE html>
<html>
<head>
    <title>Statut mis à jour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow-sm">

        <div class="card-body text-center">

            <h2 class="text-success mb-4">
                ✅ Statut mis à jour avec succès
            </h2>

            <p class="lead">
                Le colis
                <strong>{{ $package->tracking_number }}</strong>
                est maintenant :
            </p>

            <h4 class="mb-4">
                {{ ucfirst(str_replace('_', ' ', $package->status)) }}
            </h4>

            <div class="d-grid gap-3 col-md-6 mx-auto">

                <a href="{{ route('packages.index') }}"
                   class="btn btn-secondary">
                    Retour à la liste des colis
                </a>

                <a href="{{ route('packages.track', [
                    'agency' => $package->agency->slug,
                    'tracking_number' => $package->tracking_number
                ]) }}"
                   class="btn btn-primary"
                   target="_blank">
                    Voir le suivi public
                </a>

                @if(!empty($package->customer->phone))

                    <a
                        href="https://wa.me/{{ preg_replace('/\D/', '', $package->customer->phone) }}?text={{ urlencode(
                            '📦 Bonjour ' .
                            $package->customer->first_name .
                            ',' .
                            "\n\n" .
                            $package->agency->name .
                            ' vous informe que votre colis ' .
                            $package->tracking_number .
                            ' vient d\'être mis à jour.' .
                            "\n\n" .
                            '🚚 Nouveau statut : ' .
                            ucfirst(str_replace('_', ' ', $package->status)) .
                            "\n\n" .
                            '🔎 Suivi : ' .
                            route('packages.track', [
                            'agency' => $package->agency->slug,
                            'tracking_number' => $package->tracking_number,
                        ]) .
                        "\n\n" .
                        'Merci de votre confiance.' .
                        "\n" .
                        $package->agency->name
                     ) }}"
                     target="_blank"
                     class="btn btn-success">

                     📲 Notifier le client sur WhatsApp

                    </a>

                @else

                    <button class="btn btn-secondary" disabled>
                        Aucun numéro WhatsApp enregistré
                    </button>

                @endif

            </div>

        </div>

    </div>

</div>

</body>
</html>