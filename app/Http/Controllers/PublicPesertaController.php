<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicPesertaController extends Controller
{
    public function show($id)
    {
        // $peserta = Peserta::findOrFail($id);
        $peserta = Peserta::with('nilai.kategori')->findOrFail($id);
        $kategoris = Kategori::all();

        // Filter nilai berdasarkan kategori
        $akademis = $peserta->filterAkademis();
        $nonAkademis = $peserta->filterNonAkademis();

        // Hitung Rata-rata Nilai Peserta
        $meanAkademis = $peserta->calculateMean($akademis);
        $meanNonAkademis = $peserta->calculateMean($nonAkademis);

        $rataRata = $meanAkademis && $meanNonAkademis > 0 ? ($meanAkademis + $meanNonAkademis) / 2 : 0;
        return view('show-peserta', compact('peserta', 'kategoris', 'akademis', 'nonAkademis', 'meanAkademis', 'meanNonAkademis', 'rataRata'));
    }

    public function download($id)
    {
        $peserta = Peserta::findOrFail($id);

        if ($peserta->fileDokumen->file_path) {
            return Storage::disk('public')->download($peserta->fileDokumen->file_path, 'sertifikat_'."$peserta->nama".'.png');
        }

        return redirect()->back()->with('error', 'File dokumen tidak ditemukan.');
    }
}
