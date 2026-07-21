@extends('layouts.agency')

@section('title', 'Modifier une agence')

@section('content')

<div class="mb-4">
    <h1 class="mb-1">Modifier une agence</h1>
    <p class="text-muted mb-0">
        Mettre à jour les informations de l'agence
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
        Informations de l'agence
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('agencies.update', $agency) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nom de l'agence</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $agency->name) }}"
                    class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Téléphone</label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone', $agency->phone) }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $agency->email) }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Site web</label>

                <input
                    type="url"
                    name="website"
                    value="{{ old('website', $agency->website) }}"
                    class="form-control"
                    placeholder="https://www.monagence.com">

                <div class="form-text">
                    Facultatif. Ce lien sera affiché dans le portail de l'agence.
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Ville</label>

                <input
                    type="text"
                    name="city"
                    value="{{ old('city', $agency->city) }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Pays</label>

                <input
                    type="text"
                    name="country"
                    value="{{ old('country', $agency->country) }}"
                    class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">
                Enregistrer les modifications
            </button>

            <a href="{{ route('agencies.index') }}" class="btn btn-secondary">
                Annuler
            </a>

        </form>

    </div>

</div>

@endsection