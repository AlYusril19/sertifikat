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
        'tanggal_masuk',
        'tanggal_keluar',
        // 'file_dokumen',
        'nomor_sertifikat'
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
