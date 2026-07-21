@extends('layouts.agency')

@section('title', 'Modifier le statut')

@section('content')

<div class="mb-4">
    <h1 class="mb-1">Modifier le statut</h1>
    <p class="text-muted mb-0">
        Mise à jour du suivi du colis
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

    <div class="card-header bg-dark text-white">
        {{ $package->tracking_number }}
    </div>

    <div class="card-body">

        <p>
            <strong>Client :</strong>
            {{ $package->customer->first_name }}
            {{ $package->customer->last_name }}
        </p>

        <p>
            <strong>Description :</strong>
            {{ $package->description }}
        </p>

        <form method="POST" action="{{ route('packages.update', $package) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">Statut</label>

                <select name="status" class="form-select">

                    <option
                        value="received"
                        {{ $package->status == 'received' ? 'selected' : '' }}>
                        🟡 Reçu
                    </option>

                    <option
                        value="in_transit"
                        {{ $package->status == 'in_transit' ? 'selected' : '' }}>
                        🔵 En transit
                    </option>

                    <option
                        value="arrived"
                        {{ $package->status == 'arrived' ? 'selected' : '' }}>
                        🟠 Arrivé
                    </option>

                    <option
                        value="delivered"
                        {{ $package->status == 'delivered' ? 'selected' : '' }}>
                        🟢 Livré
                    </option>

                </select>

            </div>

            <button type="submit" class="btn btn-success">
                Mettre à jour
            </button>

            <a
                href="{{ route('packages.index') }}"
                class="btn btn-outline-secondary">
                Annuler
            </a>

        </form>

    </div>

</div>

@endsection