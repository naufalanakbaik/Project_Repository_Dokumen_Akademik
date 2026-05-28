<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // =========================================================
    // Form edit profile
    // =========================================================
    public function edit()
    {
        $user = auth()->user();

        return view(
            'mahasiswa.profile.edit',
            compact('user')
        );
    }

    // =========================================================
    // Update profile
    // =========================================================
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([

            // Mahasiswa
            'nim' => [
                'required',
                'string',
                'max:30',
                'unique:users,nim,' . $user->id,
            ],

            'jurusan' => [
                'nullable',
                'string',
                'max:100',
            ],

            'tahun_angkatan' => [
                'nullable',
                'digits:4',
                'integer',
                'min:2000',
                'max:' . date('Y'),
            ],

            // General
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            // Photo Profile
            'foto_profile' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:3072', // 3MB
            ],

            // Password
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],

        ]);

        // =========================================
        // Data update
        // =========================================
        $data = [

            'nim' => trim($validated['nim']),

            'jurusan' => $validated['jurusan'] ?? null,

            'tahun_angkatan' => $validated['tahun_angkatan'] ?? null,

            'name' => trim($validated['name']),

            'email' => trim($validated['email']),
        ];

        // =========================================
        // Upload foto profile
        // =========================================
        if ($request->hasFile('foto_profile')) {

            // Hapus foto lama
            if (
                $user->foto_profile &&
                Storage::disk('public')->exists(
                    $user->foto_profile
                )
            ) {
                Storage::disk('public')->delete(
                    $user->foto_profile
                );
            }

            // Simpan foto baru
            $data['foto_profile'] =
                $request->file('foto_profile')
                    ->store(
                        'profile-photos',
                        'public'
                    );
        }

        // =========================================
        // Update password jika diisi
        // =========================================
        if (!empty($validated['password'])) {

            $data['password'] =
                Hash::make($validated['password']);
        }

        // =========================================
        // Update user
        // =========================================
        $user->update($data);

        return back()->with(
            'success',
            'Profile berhasil diperbarui.'
        );
    }

    // =========================================================
    // Detail profile mahasiswa
    // =========================================================
    public function show()
    {
        $user = auth()->user();

        // Dokumen terbaru
        $documents = $user->documents()
            ->latest()
            ->take(5)
            ->get();

        // Statistik dokumen
        $totalDocuments = $user->documents()->count();

        $approved = $user->documents()
            ->where('status', 'approved')
            ->count();

        $pending = $user->documents()
            ->where('status', 'pending')
            ->count();

        $rejected = $user->documents()
            ->where('status', 'rejected')
            ->count();

        return view(
            'mahasiswa.profile.show',
            compact(
                'user',
                'documents',
                'totalDocuments',
                'approved',
                'pending',
                'rejected'
            )
        );
    }
}
