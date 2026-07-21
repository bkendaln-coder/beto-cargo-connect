@extends('layouts.agency')

@section('title', 'Agences')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="mb-1">Agences</h1>
        <p class="text-muted mb-0">
            Gestion des agences
        </p>
    </div>

    <a href="{{ route('agencies.create') }}" class="btn btn-primary">
        + Nouvelle agence
    </a>

</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm">

    <div class="card-header bg-dark text-white">
        Liste des agences
    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-striped table-hover mb-0">

                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Ville</th>
                        <th>Pays</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($agencies as $agency)

                    <tr>

                        <td>{{ $agency->name }}</td>

                        <td>{{ $agency->city }}</td>

                        <td>{{ $agency->country }}</td>

                        <td class="text-nowrap">

                            <a
                                href="{{ route('agencies.select', $agency) }}"
                                class="btn btn-success btn-sm">
                                Entrer
                            </a>

                            <a
                                href="{{ route('agencies.edit', $agency) }}"
                                class="btn btn-warning btn-sm">
                                Modifier
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            Aucune agence enregistrée.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection