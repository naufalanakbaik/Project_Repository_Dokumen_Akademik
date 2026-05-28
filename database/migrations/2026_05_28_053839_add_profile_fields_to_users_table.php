<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Mahasiswa
            $table->year('tahun_angkatan')->nullable()->after('nip');
            $table->string('jurusan')->nullable()->after('tahun_angkatan');

            // Admin, dosen, kaprodi
            $table->string('jabatan')->nullable()->after('jurusan');

            // Semua role
            $table->string('foto_profile')->nullable()->after('jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'tahun_angkatan',
                'jurusan',
                'jabatan',
                'foto_profile'
            ]);
        });
    }
};