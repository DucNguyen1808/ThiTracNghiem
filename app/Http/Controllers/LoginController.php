<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function showLogin()
    {
        return view('admin.login');
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],

        ]);

        if (Auth::attempt([...$credentials, 'quyen' => 1])) {
            $request->session()->regenerate();
            return redirect()->route('monhoc.index');
        }
        if (Auth::attempt([...$credentials, 'quyen' => 2])) {
            $request->session()->regenerate();
            return redirect()->route('user.home');
        }

        return back()->withErrors([
            'email' => 'Sai thông tin đăng nhập',
        ])->onlyInput('email');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
