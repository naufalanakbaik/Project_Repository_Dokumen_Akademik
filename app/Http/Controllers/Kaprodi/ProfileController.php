<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // ---> Form edit profile
    public function edit()
    {
        $user = auth()->user();

        return view('kaprodi.profile.edit', compact('user'));
    }

    // ---> Update profile
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([

            // Dosen (Only Dosen / Kaprodi / Admin)
            'nip' => [
                'required',
                'string',
                'max:30',
                'unique:users,nip,' . $user->id,
            ],

            'jabatan' => [
                'nullable',
                'string',
                'max:100',
            ],

            // General (All User)
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

            'foto_profile' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:3072',
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        // Data update
        $data = [
            'nip' => trim($validated['nip']),
            'jabatan' => $validated['jabatan'] ?? null,
            'name' => trim($validated['name']),
            'email' =>trim($validated['email']),
        ];

        // Upload foto profile
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

            // Upload foto baru
            $data['foto_profile'] =
                $request->file('foto_profile')
                    ->store(
                        'profile-photos',
                        'public'
                    );
        }

        // Update password jika diisi
        if (!empty($validated['password'])) {

            $data['password'] =
                Hash::make($validated['password']);
        }

        // Update user
        $user->update($data);

        return redirect()
            ->route('kaprodi.profile.show')
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }

    // ---> Detail data profile mahasiswa
    public function show()
    {
        $user = auth()->user();

        // optional: statistik
        $documents = $user->documents()->latest()->take(5)->get();

        $totalDocuments = $user->documents()->count();
        $approved = $user->documents()->where('status', 'approved')->count();
        $pending = $user->documents()->where('status', 'pending')->count();
        $rejected = $user->documents()->where('status', 'rejected')->count();

        return view('kaprodi.profile.show', compact(
            'user',
            'documents',
            'totalDocuments',
            'approved',
            'pending',
            'rejected'
        ));
    }
}
