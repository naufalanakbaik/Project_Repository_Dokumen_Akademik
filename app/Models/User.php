<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // admin, mahasiswa, dosen, kaprodi
    ];

    /**
     * Atribut yang harus disembunyikan untuk serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atribut yang harus dikonversi ke tipe data tertentu.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke model Document.
     * Seorang user dapat memiliki banyak dokumen yang diunggah.
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Relasi ke model DocumentLog.
     * Mencatat aktivitas yang dilakukan user (seperti download).
     */
    public function logs()
    {
        return $this->hasMany(DocumentLog::class);
    }
}
