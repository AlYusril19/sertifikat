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
        // 'file_dokumen',
        'nomor_sertifikat'
    ];

    // Relasi ke FileDokumen
    public function fileDokumen()
    {
        return $this->hasOne(FileDokumen::class, 'nomor_sertifikat', 'nomor_sertifikat');
    }
}
