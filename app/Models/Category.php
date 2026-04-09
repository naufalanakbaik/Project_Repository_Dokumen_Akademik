<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Atribut yang dapat diisi secara massal.
     * Table: categories
     */
    protected $fillable = ['name'];

    /**
     * Relasi ke model Document.
     * Satu kategori memiliki banyak dokumen.
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
