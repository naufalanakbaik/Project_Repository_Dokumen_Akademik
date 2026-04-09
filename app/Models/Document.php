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
        'category_id',
        'file',
        'status',
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
}
