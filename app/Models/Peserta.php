<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'ttl',
        'sekolah',
        'jurusan',
        'angkatan',
        'tanggal_masuk',
        'tanggal_keluar',
        // 'file_dokumen',
        'nomor_sertifikat',
        'nomor_cetak'
    ];
    protected $casts = [
        'tanggal_masuk' => 'datetime',
        'tanggal_keluar' => 'datetime',
    ];

    // Relasi ke FileDokumen
    public function fileDokumen()
    {
        return $this->hasOne(FileDokumen::class, 'nomor_sertifikat', 'nomor_sertifikat');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function calculateMean($nilaiCollection)
    {
        $totalNilai = $nilaiCollection->sum('nilai');
        $jumlahKategori = $nilaiCollection->count();
        return $jumlahKategori > 0 ? $totalNilai / $jumlahKategori : 0;
    }

    public function filterAkademis()
    {
        return $this->nilai->filter(function($nilai) {
            return $nilai->kategori->kategori === 'Akademis';
        });
    }

    public function filterNonAkademis()
    {
        return $this->nilai->filter(function($nilai) {
            return $nilai->kategori->kategori === 'Non-Akademis';
        });
    }
}
