<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title', session('agency_name', 'Portail logistique'))
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
        }

        .agency-navbar {
            background-color: #17212b;
        }

        .agency-brand {
            line-height: 1.15;
        }

        .agency-name {
            font-size: 1.25rem;
            font-weight: 700;
        }

        .powered-by {
            font-size: 0.72rem;
            color: rgba(255, 255, 255, 0.60);
        }

        .page-header {
            background: white;
            border-radius: 14px;
            padding: 28px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
        }

        .footer-signature {
            font-size: 0.8rem;
            color: #6c757d;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark agency-navbar">
    <div class="container">

        <a class="navbar-brand agency-brand" href="{{ route('dashboard') }}">
            <div class="agency-name">
                {{ session('agency_name', 'Portail logistique') }}
            </div>

            <div class="powered-by">
                Powered by Beto Cargo Connect
            </div>
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#agencyNavigation"
            aria-controls="agencyNavigation"
            aria-expanded="false"
            aria-label="Afficher le menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="agencyNavigation">

            <div class="navbar-nav ms-auto align-items-lg-center">

                <a class="nav-link" href="{{ route('dashboard') }}">
                    Dashboard
                </a>

                <a class="nav-link" href="{{ route('customers.index') }}">
                    Clients
                </a>

                <a class="nav-link" href="{{ route('packages.index') }}">
                    Colis
                </a>

                <a class="nav-link" href="{{ route('packages.create') }}">
                    Ajouter colis
                </a>

                @if(session('agency_website'))
                    <a
                        class="nav-link"
                        href="{{ session('agency_website') }}"
                        target="_blank"
                        rel="noopener noreferrer">
                        Site web ↗
                    </a>
                @endif

                @auth
                    @if(auth()->user()->role === 'super_admin')
                        <a class="nav-link" href="{{ route('agencies.index') }}">
                            Agences
                        </a>

                        <a class="nav-link" href="{{ route('users.index') }}">
                            Utilisateurs
                        </a>
                    @endif
                @endauth

                <form method="POST" action="{{ route('logout') }}" class="mb-0">
                    @csrf

                    <button
                        type="submit"
                        class="nav-link btn btn-link border-0 text-decoration-none">
                        Déconnexion
                    </button>
                </form>

            </div>
        </div>
    </div>
</nav>

<main class="container py-5">
    @yield('content')
</main>

<footer class="container pb-4 text-center footer-signature">
    Powered by Beto Cargo Connect
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>