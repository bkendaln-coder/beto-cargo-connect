<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>
        Suivi de colis - {{ $agency->name }}
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body{
            background:#f5f7fa;
        }

        .tracking-card{
            max-width:600px;
            margin:auto;
        }

        .agency-header{
            background:white;
            border-radius:14px;
            padding:30px;
            box-shadow:0 4px 18px rgba(0,0,0,.05);
        }

        .powered{
            font-size:.8rem;
            color:#6c757d;
        }

    </style>

</head>

<body>

<div class="container py-5">

    <div class="tracking-card">

        <div class="agency-header text-center mb-4">

            <h1 class="fw-bold">
                {{ $agency->name }}
            </h1>

            <p class="text-muted mb-2">
                Suivi de colis Canada 🇨🇦 → RDC 🇨🇩
            </p>

            @if($agency->website)

                <a href="{{ $agency->website }}"
                   target="_blank"
                   class="btn btn-outline-primary btn-sm">

                    🌐 Visiter notre site web

                </a>

            @endif

            <div class="powered mt-3">
                Powered by Beto Cargo Connect
            </div>

        </div>

        <div class="card shadow">

            <div class="card-header bg-dark text-white">

                Recherche de colis

            </div>

            <div class="card-body">

                <form
                    method="POST"
                    action="{{ route('packages.track.search', ['agency' => $agency->slug]) }}">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">

                            Numéro de suivi

                        </label>

                        <input
                            type="text"
                            name="tracking_number"
                            class="form-control"
                            placeholder="BCC-2026-000001"
                            required>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary w-100">

                        Rechercher mon colis

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>

</html>