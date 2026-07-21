@extends('layouts.agency')

@section('title', 'Ajouter un client')

@section('content')

<div class="mb-4">
    <h1 class="mb-1">Ajouter un client</h1>
    <p class="text-muted mb-0">
        Enregistrer un nouveau client
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
        Informations du client
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('customers.store') }}">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Prénom</label>

                    <input
                        type="text"
                        name="first_name"
                        value="{{ old('first_name') }}"
                        class="form-control"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nom</label>

                    <input
                        type="text"
                        name="last_name"
                        value="{{ old('last_name') }}"
                        class="form-control"
                        required>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Téléphone</label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control">
                </div>

            </div>

            <div class="mb-3">
                <label class="form-label">Adresse</label>

                <textarea
                    name="address"
                    rows="3"
                    class="form-control">{{ old('address') }}</textarea>
            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Ville</label>

                    <input
                        type="text"
                        name="city"
                        value="{{ old('city') }}"
                        class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Pays</label>

                    <input
                        type="text"
                        name="country"
                        value="{{ old('country', 'Canada') }}"
                        class="form-control">
                </div>

            </div>

            <button type="submit" class="btn btn-success">
                Enregistrer le client
            </button>

            <a href="{{ route('customers.index') }}"
               class="btn btn-outline-secondary">
                Annuler
            </a>

        </form>

    </div>

</div>

@endsection