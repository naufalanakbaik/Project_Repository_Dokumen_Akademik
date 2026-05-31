<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Document;
use App\Models\DocumentLog;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Daftar mahasiswa + search + pagination
     */
    public function mahasiswa(Request $request)
    {
        $query = User::query()
            ->where('role', 'mahasiswa')
            ->withCount('documents')
            ->with([
                'documents' => function ($q) {
                    $q->latest()
                        ->select('id', 'user_id', 'created_at');
                }
            ]);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }

        $mahasiswa = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('kaprodi.users.mahasiswa', compact('mahasiswa'));
    }

    /**
     * Detail profil mahasiswa + dokumen + statistik
     */
    public function showMahasiswa($id)
    {
        $user = User::where('role', 'mahasiswa')
            ->withCount('documents')
            ->findOrFail($id);

        $documents = Document::where('user_id', $user->id)
            ->with('category:id,name')
            ->latest()
            ->paginate(10);

        $totalDownloads = DocumentLog::where('action', 'download')
            ->whereHas('document', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->count();

        $totalPreviews = DocumentLog::where('action', 'preview')
            ->whereHas('document', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->count();

        $statusCounts = Document::where('user_id', $user->id)
            ->selectRaw("status, count(*) as total")
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('kaprodi.users.mahasiswa-show', compact(
            'user',
            'documents',
            'totalDownloads',
            'totalPreviews',
            'statusCounts'
        ));
    }

    /**
     * Daftar dosen + search + pagination
     */
    public function dosen(Request $request)
    {
        $query = User::query()
            ->where('role', 'dosen')
            ->withCount('documents')
            ->with([
                'documents' => function ($q) {
                    $q->latest()
                        ->select('id', 'user_id', 'created_at');
                }
            ]);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('nip', 'like', '%' . $request->search . '%');
            });
        }

        $dosen = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('kaprodi.users.dosen', compact('dosen'));
    }

    /**
     * Detail profil dosen + dokumen + statistik
     */
    public function showDosen($id)
    {
        $user = User::where('role', 'dosen')
            ->withCount('documents')
            ->findOrFail($id);

        $documents = Document::where('user_id', $user->id)
            ->with('category:id,name')
            ->latest()
            ->paginate(10);

        $totalDownloads = DocumentLog::where('action', 'download')
            ->whereHas('document', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->count();

        $totalPreviews = DocumentLog::where('action', 'preview')
            ->whereHas('document', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->count();

        $statusCounts = Document::where('user_id', $user->id)
            ->selectRaw("status, count(*) as total")
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('kaprodi.users.dosen-show', compact(
            'user',
            'documents',
            'totalDownloads',
            'totalPreviews',
            'statusCounts'
        ));
    }
}
