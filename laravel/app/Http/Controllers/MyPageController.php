<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MyPageController extends Controller {

    private function getLoginUser(): ?User {
        if (!session()->has('user.id')) {
            return null;
        }

        return User::find(session('user.id'));
    }

    public function index(): View|RedirectResponse {
        $user = $this->getLoginUser();

        if (!$user) {
            return redirect('/login');
        }

        return view('mypage', compact('user'));
    }

    public function edit(): View|RedirectResponse {
        $user = $this->getLoginUser();

        if (!$user) {
            return redirect('/login');
        }

        return view('mypage_edit', compact('user'));
    }

    public function update(Request $request): RedirectResponse {
        $user = $this->getLoginUser();

        if (!$user) {
            return redirect('/login');
        }

        $validated = $request->validate([
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'integer', 'in:0,1,2'],
            'age' => ['nullable', 'integer', 'min:0', 'max:150'],
            'phone' => ['nullable', 'string', 'max:255'],
            'current_password' => ['nullable', 'string'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->last_name = $validated['last_name'];
        $user->first_name = $validated['first_name'];
        $user->gender = $validated['gender'];
        $user->age = $validated['age'] ?? null;
        $user->phone = $validated['phone'] ?? null;

        if ($request->filled('new_password')) {
            if (!$request->filled('current_password')) {
                return back()
                    ->withErrors(['current_password' => '現在のパスワードを入力してください。'])
                    ->withInput();
            }

            if (!Hash::check($request->current_password, $user->password)) {
                return back()
                    ->withErrors(['current_password' => '現在のパスワードが正しくありません。'])
                    ->withInput();
            }

            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return redirect('/mypage');
    }
}
