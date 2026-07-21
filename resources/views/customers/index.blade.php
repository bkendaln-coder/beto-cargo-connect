@extends('layouts.agency')

@section('title', 'Clients')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-1">Clients</h1>
        <p class="text-muted mb-0">Gestion des clients</p>
    </div>

    <a href="{{ route('customers.create') }}" class="btn btn-primary">
        + Ajouter un client
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        Liste des clients
    </div>

    <div class="card-body">

        <form method="GET" action="{{ route('customers.index') }}" class="mb-4">
            <div class="row g-2">
                <div class="col-md-10">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        class="form-control"
                        placeholder="Rechercher par nom, téléphone, email, ville ou pays">
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        Rechercher
                    </button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Ville</th>
                        <th>Pays</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->first_name }}</td>
                            <td>{{ $customer->last_name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->city }}</td>
                            <td>{{ $customer->country }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Aucun client enregistré.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<div class="mt-4">
    <a href="{{ route('packages.index') }}" class="btn btn-outline-secondary">
        Voir les colis
    </a>
</div>

@endsection