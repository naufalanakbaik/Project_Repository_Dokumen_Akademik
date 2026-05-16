<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

    // ---> Menampilkan halaman register mahasiswa
    public function showRegister()
    {
        // Jika sudah login
        if (Auth::check()) {

            $role = auth()->user()->role;

            if (in_array($role, ['mahasiswa', 'dosen'])) {
                return redirect()->route($role . '.home');
            }

            return redirect()->route($role . '.dashboard');
        }

        return view('auth.register');
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

    // ---> Proses register mahasiswa
    public function register(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'nim' => [
                'required',
                'string',
                'max:50',
                'unique:users,nim'
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],

            'password' => [
                'required',
                'min:8',
                'confirmed'
            ],
        ]);

        // Simpan user mahasiswa
        $user = User::create([
            'name' => $validated['name'],
            'nim' => $validated['nim'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'mahasiswa',
        ]);

        // Auto login
        Auth::login($user);

        return redirect()
            ->route('mahasiswa.home')
            ->with('success', 'Registrasi berhasil.');
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
