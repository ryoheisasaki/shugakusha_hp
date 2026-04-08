<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {

    public function create() {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse {

        $validated = $request->validate([
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // ★ここが管理者判定
        $is_admin = $validated['email'] === 'info@shugakusha.jp';

        $user = User::create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => $is_admin,
        ]);

        session([
            'user' => [
                'id' => $user->id,
                'name' => trim($user->last_name . ' ' . $user->first_name),
                'email' => $user->email,
            ]
        ]);

        return redirect('/')->with('success', '会員登録が完了しました。');
    }
}
