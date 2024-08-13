<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileDokumen extends Model
{
    use HasFactory;
    protected $fillable = ['nomor_sertifikat', 'file_path'];

    // Relasi ke Peserta
    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'nomor_sertifikat', 'nomor_sertifikat');
    }
}
