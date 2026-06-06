<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\DocumentLog;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Daftar aktivitas pengguna + search + filter + pagination
     */
    public function index(Request $request)
    {
        $query = DocumentLog::query()
            ->with([
                'user:id,name',
                'document:id,title'
            ]);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('user', function ($user) use ($request) {
                    $user->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('document', function ($doc) use ($request) {
                    $doc->where('title', 'like', '%' . $request->search . '%');
                });
            });
        }

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        $logs = $query
            ->latest()
            ->paginate(30)
            ->withQueryString();

        return view('kaprodi.activity.index', compact('logs'));
    }

    /**
     * Detail aktivitas tunggal
     */
    public function show($id)
    {
        $log = DocumentLog::with([
            'user',
            'document.category',
            'document.user'
        ])->findOrFail($id);

        // Log aktivitas lain dari user yang sama
        $relatedLogs = DocumentLog::where('user_id', $log->user_id)
            ->where('id', '!=', $log->id)
            ->with('document:id,title')
            ->latest()
            ->take(10)
            ->get();

        return view('kaprodi.activity.show', compact('log', 'relatedLogs'));
    }
}
