<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->search;

        $users = User::with('agency')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($searchQuery) use ($search) {
                    $searchQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('role', 'like', "%{$search}%")
                        ->orWhereHas('agency', function ($agencyQuery) use ($search) {
                            $agencyQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('name')
            ->get();

        return view('users.index', compact('users', 'search'));
    }

    public function create(): View
    {
        $agencies = Agency::orderBy('name')->get();

        return view('users.create', compact('agencies'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'agency_id' => 'nullable|exists:agencies,id',
            'role' => [
                'required',
                Rule::in(['super_admin', 'agency_admin']),
            ],
        ]);

        User::create($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        $agencies = Agency::orderBy('name')->get();

        return view('users.edit', compact('user', 'agencies'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'agency_id' => 'nullable|exists:agencies,id',
            'role' => [
                'required',
                Rule::in(['super_admin', 'agency_admin']),
            ],
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Utilisateur modifié avec succès.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        if ($user->role === 'super_admin') {

            $superAdmins = User::where('role', 'super_admin')->count();

            if ($superAdmins <= 1) {
                return redirect()
                    ->route('users.index')
                    ->with('error', 'Impossible de supprimer le dernier Super Admin.');
            }
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}
