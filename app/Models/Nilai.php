<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $fillable = [
        'peserta_id',
        'kategori_id',
        'nilai',
    ];
    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
