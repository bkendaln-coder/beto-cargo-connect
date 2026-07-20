<!DOCTYPE html>
<html>
<head>
    <title>Modifier une agence - Beto Cargo Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h1>Modifier l'agence</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('agencies.update', $agency) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nom de l'agence</label>
            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name', $agency->name) }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input
                type="text"
                name="phone"
                class="form-control"
                value="{{ old('phone', $agency->phone) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email', $agency->email) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Site web</label>
            <input
                type="url"
                name="website"
                class="form-control"
                value="{{ old('website', $agency->website) }}"
                placeholder="https://www.monagence.com">
        </div>

        <div class="mb-3">
            <label class="form-label">Ville</label>
            <input
                type="text"
                name="city"
                class="form-control"
                value="{{ old('city', $agency->city) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Pays</label>
            <input
                type="text"
                name="country"
                class="form-control"
                value="{{ old('country', $agency->country) }}">
        </div>

        <button type="submit" class="btn btn-primary">
            Enregistrer
        </button>

        <a href="{{ route('agencies.index') }}" class="btn btn-secondary">
            Annuler
        </a>

    </form>

</div>

</body>
</html>