@extends('layouts.agency')

@section('title', 'Nouvel utilisateur')

@section('content')

<div class="mb-4">
    <h1 class="mb-1">Nouvel utilisateur</h1>
    <p class="text-muted mb-0">
        Créer un nouvel utilisateur
    </p>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm">

    <div class="card-header bg-primary text-white">
        Informations de l'utilisateur
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nom complet</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
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
                            {{ old('agency_id') == $agency->id ? 'selected' : '' }}>

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
                        {{ old('role') == 'agency_admin' ? 'selected' : '' }}>

                        Admin Agence

                    </option>

                    <option
                        value="super_admin"
                        {{ old('role') == 'super_admin' ? 'selected' : '' }}>

                        Super Admin

                    </option>

                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Mot de passe</label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmer le mot de passe</label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">
                Enregistrer
            </button>

            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                Annuler
            </a>

        </form>

    </div>

</div>

@endsection