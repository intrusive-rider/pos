<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function showRegistrasi() {
        return view('auth.auth-signup');
    }

    function submitRegistrasi(Request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('login');
    }

    function showLogin() {
        return view('auth.auth-signin');
    }

    function submitLogin(Request $request)
    {
        $data = $request->only('email','password');

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('gagal','Email atau password anda salah');
        }
    }

    function logout() {
        Auth::logout();
        return redirect()->route('login');
    }


    
}
