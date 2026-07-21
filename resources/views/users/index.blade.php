@extends('layouts.agency')

@section('title', 'Utilisateurs')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-1">Utilisateurs</h1>
        <p class="text-muted mb-0">
            Gestion des utilisateurs
        </p>
    </div>

    <a href="{{ route('users.create') }}" class="btn btn-primary">
        + Nouvel utilisateur
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        Liste des utilisateurs
    </div>

    <div class="card-body">

        <form method="GET" action="{{ route('users.index') }}" class="mb-4">
            <div class="row g-2">
                <div class="col-md-10">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        class="form-control"
                        placeholder="Rechercher par nom, email, agence ou rôle">
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        Rechercher
                    </button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Agence</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>

                            <td>{{ $user->email }}</td>

                            <td>{{ $user->agency?->name ?? '-' }}</td>

                            <td>
                                @if($user->role === 'super_admin')
                                    <span class="badge bg-danger">
                                        Super Admin
                                    </span>
                                @else
                                    <span class="badge bg-primary">
                                        Admin Agence
                                    </span>
                                @endif
                            </td>

                            <td class="text-nowrap">
                                <a
                                    href="{{ route('users.edit', $user) }}"
                                    class="btn btn-warning btn-sm">
                                    Modifier
                                </a>

                                <form
                                    action="{{ route('users.destroy', $user) }}"
                                    method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Supprimer cet utilisateur ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Aucun utilisateur enregistré.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection