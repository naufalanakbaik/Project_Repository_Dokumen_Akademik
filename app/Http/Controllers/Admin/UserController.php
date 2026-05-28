<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // ---> List user + search + filter role
    public function index(Request $request)
    {
        $search = trim($request->search);
        $role = $request->role;

        $users = User::query()
            ->select([
                'id',
                'name',
                'email',
                'role',
                'nim',
                'nip',
                'jabatan',
                'tahun_angkatan',
                'jurusan',
                'foto_profile',
                'created_at'
            ])

            // Total dokumen tanpa N+1
            ->withCount('documents')

            // Search user
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })

            // Filter role
            ->when($role, function ($query) use ($role) {
                $query->where('role', $role);
            })

            ->latest()
            ->paginate(10) // Pagination
            ->withQueryString(); // Pertahankan query di pagination

        return view('admin.users.index', compact('users'));
    }


    // ---> Form tambah user
    public function create()
    {
        return view('admin.users.create');
    }


    // ---> Simpan user
    public function store(Request $request)
    {
        $role = $request->role;

        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|string|email|max:255|unique:users,email',

            'password' => 'required|string|min:8',

            'role' => 'required|in:admin,mahasiswa,dosen,kaprodi',

            // Mahasiswa
            'nim' => $role === 'mahasiswa'
                ? 'required|string|max:30|unique:users,nim'
                : 'nullable',

            'tahun_angkatan' => $role === 'mahasiswa'
                ? 'required|digits:4'
                : 'nullable',

            'jurusan' => $role === 'mahasiswa'
                ? 'required|string|max:255'
                : 'nullable',

            // Admin / dosen / kaprodi
            'nip' => in_array($role, ['admin', 'dosen', 'kaprodi'])
                ? 'required|string|max:30|unique:users,nip'
                : 'nullable',

            'jabatan' => in_array($role, ['admin', 'dosen', 'kaprodi'])
                ? 'required|string|max:255'
                : 'nullable',

            // Foto profile
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
        ]);

        $data = [
            'name' => trim($validated['name']),
            'email' => trim($validated['email']),
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],

            'nim' => $validated['nim'] ?? null,
            'nip' => $validated['nip'] ?? null,

            'tahun_angkatan' => $validated['tahun_angkatan'] ?? null,
            'jurusan' => $validated['jurusan'] ?? null,

            'jabatan' => $validated['jabatan'] ?? null,
        ];

        // Upload foto profile
        if ($request->hasFile('foto_profile')) {

            $path = $request->file('foto_profile')
                ->store('foto-profile', 'public');

            $data['foto_profile'] = $path;
        }

        User::create($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }


    // ---> Form edit user
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }


    // ---> Update user
    public function update(Request $request, User $user)
    {
        $role = $request->role;

        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,

            'role' => 'required|in:admin,mahasiswa,dosen,kaprodi',

            'password' => 'nullable|string|min:8',

            // Mahasiswa
            'nim' => $role === 'mahasiswa'
                ? 'required|string|max:30|unique:users,nim,' . $user->id
                : 'nullable',

            'tahun_angkatan' => $role === 'mahasiswa'
                ? 'required|digits:4'
                : 'nullable',

            'jurusan' => $role === 'mahasiswa'
                ? 'required|string|max:255'
                : 'nullable',

            // Admin / dosen / kaprodi
            'nip' => in_array($role, ['admin', 'dosen', 'kaprodi'])
                ? 'required|string|max:30|unique:users,nip,' . $user->id
                : 'nullable',

            'jabatan' => in_array($role, ['admin', 'dosen', 'kaprodi'])
                ? 'required|string|max:255'
                : 'nullable',

            // Foto profile
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
        ]);

        $data = [
            'name' => trim($validated['name']),
            'email' => trim($validated['email']),
            'role' => $validated['role'],

            // Reset field otomatis
            'nim' => $role === 'mahasiswa'
                ? $validated['nim']
                : null,

            'tahun_angkatan' => $role === 'mahasiswa'
                ? $validated['tahun_angkatan']
                : null,

            'jurusan' => $role === 'mahasiswa'
                ? $validated['jurusan']
                : null,

            'nip' => in_array($role, ['admin', 'dosen', 'kaprodi'])
                ? $validated['nip']
                : null,

            'jabatan' => in_array($role, ['admin', 'dosen', 'kaprodi'])
                ? $validated['jabatan']
                : null,
        ];

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        // Upload foto profile
        if ($request->hasFile('foto_profile')) {

            // Hapus foto lama
            if (
                $user->foto_profile &&
                \Storage::disk('public')->exists($user->foto_profile)
            ) {

                \Storage::disk('public')
                    ->delete($user->foto_profile);
            }

            $path = $request->file('foto_profile')
                ->store('foto-profile', 'public');

            $data['foto_profile'] = $path;
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diupdate');
    }


    // ---> Detail user
    public function show(User $user)
    {
        $user->load([
            // Eager loading aman dari N+1
            'documents:id,user_id,title,status,created_at',
            'logs:id,user_id,action,created_at'
        ])

            // Count tanpa query tambahan
            ->loadCount([
                'documents',
                'logs'
            ]);

        return view('admin.users.show', compact('user'));
    }


    // ---> Hapus user
    public function destroy(User $user)
    {
        // Cegah admin menghapus dirinya sendiri
        if (auth()->id() === $user->id) {
            return back()->with(
                'error',
                'Anda tidak dapat menghapus akun sendiri.'
            );
        }

        $user->delete();

        return back()->with(
            'success',
            'User berhasil dihapus'
        );
    }
}
