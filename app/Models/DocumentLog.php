<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentLog extends Model
{
    /**
     * Atribut yang dapat diisi secara massal.
     * Table: document_logs
     */
    protected $fillable = [
        'user_id',
        'document_id',
        'action', // upload, download, approve, reject
    ];

    /**
     * Relasi ke model User (Siapa yang melakukan aksi).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Document (Dokumen yang dikenakan aksi).
     */
    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
