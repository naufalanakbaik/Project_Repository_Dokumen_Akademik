<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ---> Menampilkan halaman login
    public function showLogin()
    {
        // Jika sudah login
        if (Auth::check()) {

            $role = auth()->user()->role;

            // Mahasiswa & dosen -> katalog global
            if (in_array($role, ['mahasiswa', 'dosen'])) {
                return redirect()->route($role . '.home');
            }

            // Role lain -> dashboard
            return redirect()->route($role . '.dashboard');
        }

        return view('auth.login');
    }


    // ---> Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $role = auth()->user()->role;

            // Mahasiswa & dosen
            if (in_array($role, ['mahasiswa', 'dosen'])) {
                return redirect()->route($role . '.home');
            }

            // Admin & kaprodi
            return redirect()->route($role . '.dashboard');
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah',
            ])
            ->onlyInput('email');
    }


    // ---> Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}