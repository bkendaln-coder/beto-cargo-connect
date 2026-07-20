<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle agence - Beto Cargo Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h1>Nouvelle agence</h1>

    <form method="POST" action="{{ route('agencies.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nom de l'agence</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Site web</label>

            <input
                type="url"
                name="website"
                class="form-control"
                placeholder="https://www.monagence.com">

            <div class="form-text">
                Facultatif. Ce lien sera affiché dans le portail de l'agence.
            </div>
        </div>


        <div class="mb-3">
            <label class="form-label">Ville</label>
            <input type="text" name="city" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Pays</label>
            <input type="text" name="country" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>

        <a href="{{ route('agencies.index') }}" class="btn btn-secondary">
            Annuler
        </a>
    </form>

</div>

</body>
</html>