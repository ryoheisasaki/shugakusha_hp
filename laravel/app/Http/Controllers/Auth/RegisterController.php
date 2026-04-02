<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegisterController extends Controller {
    public function create(): View {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse {
        $validated = $request->validate([
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'integer', 'in:0,1,2'],
            'age' => ['nullable', 'integer', 'min:0', 'max:120'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::query()->create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'gender' => (int) $validated['gender'],
            'age' => $validated['age'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        session([
            'user' => [
                'id' => $user->id,
                'name' => $user->last_name . ' ' . $user->first_name,
                'email' => $user->email,
            ],
        ]);

        return redirect('/')->with('success', '会員登録が完了しました。');
    }
}
