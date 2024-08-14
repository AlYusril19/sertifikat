<?php

namespace App\Http\Controllers;

use App\Models\FileDokumen;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sertifikats = FileDokumen::all();
        return view('admin.index-sertifikat',  compact('sertifikats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        {
            // $pesertas = Peserta::all(); // Mengambil semua data peserta
            $pesertas = Peserta::whereNotIn('nomor_sertifikat', FileDokumen::pluck('nomor_sertifikat'))->get(['id', 'nama', 'nomor_sertifikat']);
            return view('admin.sertifikat', compact('pesertas'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomor_sertifikat' => 'required|string|exists:pesertas,nomor_sertifikat|unique:file_dokumens,nomor_sertifikat',
            'file_dokumen' => 'required|file|mimes:pdf,doc,docx,png|max:2048',
        ]);

        $filePath = $request->file('file_dokumen')->store('documents', 'public');

        FileDokumen::create([
            'nomor_sertifikat' => $validatedData['nomor_sertifikat'],
            'file_path' => $filePath,
        ]);

        return redirect()->route('file_dokumen.index')->with('success', 'Dokumen berhasil diupload');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sertifikat = FileDokumen::findOrFail($id);
        return view('admin.edit-sertifikat', compact('sertifikat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            // 'nomor_sertifikat' => 'required|string|max:255|unique:file_dokumens,nomor_sertifikat,' . $id,
            'file_path' => 'required|file|mimes:pdf,doc,docx,png|max:2048',
        ]);
        
        try {
            $sertifikat = FileDokumen::findOrFail($id);
            
            // Hapus file lama jika ada
            if ($sertifikat->file_path) {
                Storage::disk('public')->delete($sertifikat->file_path);
            }
            
            // Simpan file baru
            $filePath = $request->file('file_path')->store('documents', 'public');
            
            // Update data sertifikat
            $sertifikat->update([
                'nomor_sertifikat' => $request->nomor_sertifikat,
                'file_path' => $filePath,
            ]);

            return redirect()->route('file_dokumen.index')->with('success', 'Sertifikat berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('file_dokumen.edit', $id)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $sertifikat = FileDokumen::findOrFail($id);

            // Hapus file dari storage jika ada
            if ($sertifikat->file_path) {
                Storage::disk('public')->delete($sertifikat->file_path);
            }

            // Hapus data sertifikat dari database
            $sertifikat->delete();

            return redirect()->route('file_dokumen.index')->with('success', 'Sertifikat berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('file_dokumen.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
