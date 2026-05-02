<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // --- Form edit profile
    public function edit()
    {
        $user = auth()->user();

        return view('mahasiswa.profile.edit', compact('user'));
    }

    // --- Update profile
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Password hanya diupdate jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    // --- Detail data profile mahasiswa
    public function show()
    {
        $user = auth()->user();

        // optional: statistik
        $documents = $user->documents()->latest()->take(5)->get();

        $totalDocuments = $user->documents()->count();
        $approved = $user->documents()->where('status', 'approved')->count();
        $pending = $user->documents()->where('status', 'pending')->count();
        $rejected = $user->documents()->where('status', 'rejected')->count();

        return view('mahasiswa.profile.show', compact(
            'user',
            'documents',
            'totalDocuments',
            'approved',
            'pending',
            'rejected'
        ));
    }
}
