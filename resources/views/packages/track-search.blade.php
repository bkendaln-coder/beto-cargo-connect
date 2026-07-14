<!DOCTYPE html>
<html>
<head>
    <title>Suivi de colis - {{ $agency->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-dark text-white">
                    Recherche de colis
                </div>

                <div class="card-body">

                    <h3 class="mb-3">
                        🚢 {{ $agency->name }}
                    </h3>

                    <p class="text-muted">
                        Suivez votre colis entre le Canada 🇨🇦 et la RDC 🇨🇩
                    </p>

                    <form method="POST"
                          action="{{ route('packages.track.search', ['agency' => $agency->slug]) }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">
                                Numéro de suivi
                            </label>

                            <input type="text"
                                   name="tracking_number"
                                   class="form-control"
                                   placeholder="BCC-2026-000001"
                                   required>
                        </div>

                        <button type="submit"
                                class="btn btn-primary w-100">
                            Rechercher
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>