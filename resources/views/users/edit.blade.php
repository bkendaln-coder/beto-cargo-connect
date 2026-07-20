<!DOCTYPE html>
<html>
<head>
    <title>Modifier utilisateur - Beto Cargo Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h1>Modifier l'utilisateur</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nom complet</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Agence</label>

            <select name="agency_id" class="form-select">
                <option value="">Aucune agence</option>

                @foreach($agencies as $agency)
                    <option
                        value="{{ $agency->id }}"
                        {{ (string) old('agency_id', $user->agency_id) === (string) $agency->id ? 'selected' : '' }}>
                        {{ $agency->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Rôle</label>

            <select name="role" class="form-select" required>
                <option
                    value="agency_admin"
                    {{ old('role', $user->role) === 'agency_admin' ? 'selected' : '' }}>
                    Admin Agence
                </option>

                <option
                    value="super_admin"
                    {{ old('role', $user->role) === 'super_admin' ? 'selected' : '' }}>
                    Super Admin
                </option>
            </select>
        </div>

        <hr>

        <div class="mb-3">
            <label class="form-label">Nouveau mot de passe</label>

            <input
                type="password"
                name="password"
                class="form-control">

            <div class="form-text">
                Laisse ce champ vide pour conserver le mot de passe actuel.
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirmer le nouveau mot de passe</label>

            <input
                type="password"
                name="password_confirmation"
                class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">
            Enregistrer les modifications
        </button>

        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            Annuler
        </a>
    </form>

</div>

</body>
</html>