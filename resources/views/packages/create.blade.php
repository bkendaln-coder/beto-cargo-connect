@extends('layouts.agency')

@section('title', 'Ajouter un colis')

@section('content')

<div class="mb-4">
    <h1 class="mb-1">Ajouter un colis</h1>
    <p class="text-muted mb-0">
        Créer un nouveau colis
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
        Informations du colis
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('packages.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Client</label>

                <select name="customer_id" class="form-select" required>
                    <option value="">-- Choisir un client --</option>

                    @foreach($customers as $customer)
                        <option
                            value="{{ $customer->id }}"
                            {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->first_name }}
                            {{ $customer->last_name }}
                            -
                            {{ $customer->phone }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Description du colis</label>

                <input
                    type="text"
                    name="description"
                    value="{{ old('description') }}"
                    class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Poids KG</label>

                <input
                    type="number"
                    step="0.01"
                    name="weight_kg"
                    value="{{ old('weight_kg') }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Mode de transport</label>

                <select name="transport_mode" class="form-select" required>
                    <option
                        value="air"
                        {{ old('transport_mode') === 'air' ? 'selected' : '' }}>
                        ✈️ Fret aérien
                    </option>

                    <option
                        value="sea_groupage"
                        {{ old('transport_mode') === 'sea_groupage' ? 'selected' : '' }}>
                        🚢 Maritime - Groupage
                    </option>

                    <option
                        value="full_container"
                        {{ old('transport_mode') === 'full_container' ? 'selected' : '' }}>
                        📦 Conteneur complet
                    </option>

                    <option
                        value="local_delivery"
                        {{ old('transport_mode') === 'local_delivery' ? 'selected' : '' }}>
                        🚚 Livraison locale
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Ville d'origine</label>

                <input
                    type="text"
                    name="origin_city"
                    value="{{ old('origin_city', 'Toronto') }}"
                    class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Ville destination</label>

                <input
                    type="text"
                    name="destination_city"
                    value="{{ old('destination_city', 'Kinshasa') }}"
                    class="form-control"
                    required>
            </div>

            <button type="submit" class="btn btn-success">
                Enregistrer le colis
            </button>

            <a href="{{ route('packages.index') }}" class="btn btn-outline-secondary">
                Annuler
            </a>
        </form>
    </div>
</div>

@endsection