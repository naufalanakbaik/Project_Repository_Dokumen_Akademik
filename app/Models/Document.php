<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /**
     * Field yang boleh diisi mass assignment
     */
    protected $fillable = [
        'title',
        'tahun_terbit',
        'category_id',
        'user_id',
        'file',
        'status',
        'reject_note',
        'rejected_at',
        'rejected_by',
    ];

    protected $casts = [
        'rejected_at' => 'datetime',
    ];

    /**
     * Relasi ke User (pemilik dokumen)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke DocumentLog (riwayat aktivitas)
     */
    public function logs()
    {
        return $this->hasMany(DocumentLog::class);
    }

    /**
     * Relasi penolakan dokumen
     */
    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    /**
     * Relasi dokumen favorit
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(
            User::class,
            'favorite_documents'

        )->withTimestamps();
    }
}
