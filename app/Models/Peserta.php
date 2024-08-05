<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'ttl',
        'sekolah',
        'jurusan',
        'file_dokumen',
        'nomor_sertifikat'
    ];
}
