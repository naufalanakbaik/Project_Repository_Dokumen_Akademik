<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Menangani permintaan yang masuk.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles  Daftar role yang diizinkan (misal: admin, dosen)
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Pastikan user sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 2. Ambil role user saat ini
        $userRole = auth()->user()->role;

        // 3. Periksa apakah role user ada dalam daftar role yang diizinkan
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // 4. Jika tidak memiliki akses, tampilkan error 403 (Forbidden)
        abort(403, 'Anda tidak memiliki hak akses untuk halaman ini.');
    }
}
