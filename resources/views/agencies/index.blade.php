<!DOCTYPE html>
<html>
<head>
    <title>Agences - Beto Cargo Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Agences</h1>

        <a href="{{ route('agencies.create') }}" class="btn btn-primary">
            + Nouvelle agence
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>Nom</th>
                <th>Ville</th>
                <th>Pays</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        @forelse($agencies as $agency)

            <tr>

                <td>{{ $agency->name }}</td>

                <td>{{ $agency->city }}</td>

                <td>{{ $agency->country }}</td>

                <td>
                    <a href="{{ route('agencies.select', $agency) }}" class="btn btn-success btn-sm">
                        Entrer
                    </a>

                    <a href="{{ route('agencies.edit', $agency) }}" class="btn btn-warning btn-sm">
                        Modifier
                    </a>
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="3" class="text-center">
                    Aucune agence enregistrée.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

</body>
</html>