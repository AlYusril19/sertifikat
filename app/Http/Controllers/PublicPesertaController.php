<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicPesertaController extends Controller
{
    public function show($id)
    {
        $peserta = Peserta::findOrFail($id);
        return view('show-peserta', compact('peserta'));
    }

    public function download($id)
    {
        $peserta = Peserta::findOrFail($id);

        if ($peserta->file_dokumen) {
            return Storage::disk('public')->download($peserta->file_dokumen);
        }

        return redirect()->back()->with('error', 'File dokumen tidak ditemukan.');
    }
}
