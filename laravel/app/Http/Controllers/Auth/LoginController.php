<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller {

    public function create() {
        return view('auth.login');
    }

    public function store(Request $request) {
        $user = User::where('email', $request->email)->first();

        if (!$user || !\Hash::check($request->password, $user->password)) {
            return back()->withErrors(['ログイン情報が正しくありません']);
        }

        session([
            'user' => [
                'id' => $user->id,
                'name' => $user->last_name . ' ' . $user->first_name,
            ]
        ]);

        return redirect('/books');
    }

    public function destroy() {
        session()->forget('user');
        return redirect('/');
    }
}
