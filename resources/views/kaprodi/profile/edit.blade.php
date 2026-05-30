@extends('kaprodi.layouts.app')
@section('title', 'Edit Profil')

@push('styles')
<style>
    :root {
        --border: #e5e7eb;
        --surface: #ffffff;
        --surface-subtle: #f9fafb;
        --text-primary: #111827;
        --text-secondary: #6b7280;
        --text-muted: #9ca3af;
        --radius-card: 12px;
        --shadow-card: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
        --transition: all .18s cubic-bezier(.4,0,.2,1);
    }
    .card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-card);
        box-shadow: var(--shadow-card);
    }
    .form-label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 5px;
        letter-spacing: .01em;
    }
    .form-input {
        width: 100%;
        padding: 9px 12px;
        font-size: 13.5px;
        color: var(--text-primary);
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 8px;
        transition: var(--transition);
    }
    .form-input:focus {
        outline: none;
        border-color: #93c5fd;
        box-shadow: 0 0 0 3px rgba(59,130,246,.1);
    }
    .form-input.error { border-color: #fca5a5; }
    .form-error {
        font-size: 11.5px;
        color: #dc2626;
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 3px;
    }
    .form-hint {
        font-size: 11.5px;
        color: var(--text-muted);
        margin-top: 4px;
    }
    .card-header {
        padding: 16px 20px;
        border-bottom: 1px solid var(--border);
    }
    .card-body { padding: 20px; }
</style>
@endpush

@section('content')
<div class="space-y-5 pb-6">

    {{-- ═══ PAGE HEADER ═══ --}}
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-1.5 text-xs text-gray-400 mb-1.5">
                <span class="material-symbols-outlined !text-[13px]">grid_view</span>
                <span>Kaprodi</span>
                <span class="material-symbols-outlined !text-[13px]">chevron_right</span>
                <a href="{{ route('kaprodi.profile.show', Auth::id()) }}" class="hover:text-gray-600 transition">Profil Saya</a>
                <span class="material-symbols-outlined !text-[13px]">chevron_right</span>
                <span class="text-gray-600 font-medium">Edit</span>
            </div>
            <h1 class="text-xl font-semibold text-gray-900 tracking-tight">Edit Profil</h1>
            <p class="text-sm text-gray-400 mt-0.5">Perbarui informasi akun dan keamanan Anda</p>
        </div>
        <a href="{{ route('kaprodi.profile.show', Auth::id()) }}"
            class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-600 border border-gray-200 px-4 py-2 rounded-lg bg-white hover:bg-gray-50 transition shadow-sm">
            <span class="material-symbols-outlined !text-[15px]">arrow_back</span>
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('kaprodi.profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            {{-- ═══ LEFT: Profile Summary Card ═══ --}}
            <div class="lg:col-span-1">
                <div class="card overflow-hidden sticky top-4">
                    {{-- Mini banner --}}
                    <div class="h-16 bg-gradient-to-br from-gray-100 to-white border-b border-gray-100"></div>

                    {{-- Avatar + info --}}
                    <div class="px-5 pb-5 -mt-8 flex flex-col items-center text-center">
                        @if($user->foto_profile)
                            <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                                 class="w-16 h-16 rounded-full object-cover border-3 border-white shadow-md ring-1 ring-gray-200">
                        @else
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 border-3 border-white shadow-md flex items-center justify-center ring-1 ring-gray-200">
                                <span class="text-xl font-bold text-white uppercase">
                                    {{ \Illuminate\Support\Str::substr($user->name, 0, 1) }}
                                </span>
                            </div>
                        @endif

                        <h3 class="mt-3 text-sm font-semibold text-gray-900">{{ $user->name }}</h3>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $user->email }}</p>
                        <span class="mt-2 inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100 capitalize">
                            {{ $user->role }}
                        </span>
                    </div>

                    {{-- Info tipis --}}
                    <div class="border-t border-gray-100 px-5 py-4 space-y-2">
                        <p class="text-xs text-gray-500 font-medium mb-2">Ketentuan Pengisian</p>
                        @foreach(['Gunakan email aktif dan valid', 'Password minimal 8 karakter', 'Foto maks. 3MB (JPG, PNG)', 'Perubahan bersifat permanen'] as $tips)
                            <div class="flex items-start gap-1.5 text-xs text-gray-400">
                                <span class="material-symbols-outlined !text-[12px] text-gray-300 mt-0.5 flex-shrink-0">circle</span>
                                {{ $tips }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ═══ RIGHT: Forms ═══ --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Informasi Profil --}}
                <div class="card">
                    <div class="card-header flex items-center gap-2">
                        <span class="material-symbols-outlined !text-[16px] text-gray-400">person</span>
                        <div>
                            <h2 class="text-sm font-semibold text-gray-800">Informasi Profil</h2>
                            <p class="text-xs text-gray-400 mt-0.5">Perbarui data identitas dasar akun Anda</p>
                        </div>
                    </div>
                    <div class="card-body space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- NIP --}}
                            <div>
                                <label class="form-label">NIP</label>
                                <input type="text" name="nip" value="{{ old('nip', $user->nip) }}"
                                    placeholder="Nomor Induk Pegawai"
                                    class="form-input {{ $errors->has('nip') ? 'error' : '' }}">
                                @error('nip')
                                    <p class="form-error"><span class="material-symbols-outlined !text-[12px]">error</span>{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Jabatan --}}
                            <div>
                                <label class="form-label">Jabatan</label>
                                <input type="text" name="jabatan" value="{{ old('jabatan', $user->jabatan) }}"
                                    placeholder="Jabatan / posisi"
                                    class="form-input {{ $errors->has('jabatan') ? 'error' : '' }}">
                                @error('jabatan')
                                    <p class="form-error"><span class="material-symbols-outlined !text-[12px]">error</span>{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Nama --}}
                        <div>
                            <label class="form-label">Nama Lengkap <span class="text-red-400">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                placeholder="Nama lengkap Anda"
                                class="form-input {{ $errors->has('name') ? 'error' : '' }}">
                            @error('name')
                                <p class="form-error"><span class="material-symbols-outlined !text-[12px]">error</span>{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="form-label">Email <span class="text-red-400">*</span></label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                placeholder="nama@email.com"
                                class="form-input {{ $errors->has('email') ? 'error' : '' }}">
                            @error('email')
                                <p class="form-error"><span class="material-symbols-outlined !text-[12px]">error</span>{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Foto Profil --}}
                        <div>
                            <label class="form-label">Foto Profil</label>
                            <div class="mt-1 flex items-center gap-3">
                                @if($user->foto_profile)
                                    <img src="{{ $user->photo_url }}" alt="Current photo"
                                         class="w-10 h-10 rounded-full object-cover border border-gray-200">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center border border-gray-200">
                                        <span class="text-white text-sm font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    </div>
                                @endif
                                <input type="file" name="foto_profile" accept="image/*"
                                    class="block text-sm text-gray-600 border border-gray-200 rounded-lg cursor-pointer bg-gray-50
                                    file:mr-3 file:py-2 file:px-3 file:border-0 file:text-xs file:font-medium
                                    file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 flex-1">
                            </div>
                            <p class="form-hint">JPG, JPEG, PNG · Maks. 3MB</p>
                            @error('foto_profile')
                                <p class="form-error"><span class="material-symbols-outlined !text-[12px]">error</span>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Keamanan Akun --}}
                <div class="card">
                    <div class="card-header flex items-center gap-2">
                        <span class="material-symbols-outlined !text-[16px] text-gray-400">lock</span>
                        <div>
                            <h2 class="text-sm font-semibold text-gray-800">Keamanan Akun</h2>
                            <p class="text-xs text-gray-400 mt-0.5">Kosongkan kolom password jika tidak ingin menggantinya</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Password Baru --}}
                            <div>
                                <label class="form-label">Password Baru</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password"
                                        placeholder="Minimal 8 karakter"
                                        class="form-input pr-10 {{ $errors->has('password') ? 'error' : '' }}">
                                    <button type="button" onclick="togglePwd('password', this)"
                                        class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600 transition">
                                        <span class="material-symbols-outlined !text-[17px]">visibility</span>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="form-error"><span class="material-symbols-outlined !text-[12px]">error</span>{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Konfirmasi --}}
                            <div>
                                <label class="form-label">Konfirmasi Password</label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        placeholder="Ulangi password baru"
                                        class="form-input pr-10">
                                    <button type="button" onclick="togglePwd('password_confirmation', this)"
                                        class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600 transition">
                                        <span class="material-symbols-outlined !text-[17px]">visibility</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="flex items-center justify-between pt-1">
                    <a href="{{ route('kaprodi.profile.show', Auth::id()) }}"
                        class="text-sm text-gray-500 hover:text-gray-700 transition">
                        Batal, kembali ke profil
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 rounded-lg transition shadow-sm">
                        <span class="material-symbols-outlined !text-[16px]">save</span>
                        Simpan Perubahan
                    </button>
                </div>

            </div>
        </div>
    </form>
</div>

<script>
    function togglePwd(id, btn) {
        const input = document.getElementById(id);
        const icon = btn.querySelector('span');
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    }
</script>
@endsection
