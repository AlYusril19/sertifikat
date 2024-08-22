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
}
