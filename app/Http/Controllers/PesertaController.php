<?php

namespace App\Http\Controllers;

use App\Models\FileDokumen;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesertas = Peserta::all();
        return view('admin.index-peserta', compact('pesertas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create-peserta');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'nama' => 'required|string|max:64',
            'ttl' => 'required|string|max:64',
            'sekolah' => 'required|string|max:64',
            'jurusan' => 'required|string|max:64',
            'nomor_sertifikat' => 'nullable|string|max:32|unique:pesertas,nomor_sertifikat',
        ]);

        try {
            $peserta = Peserta::create([
                'nama' => $request->nama,
                'ttl' => $request->ttl,
                'sekolah' => $request->sekolah,
                'jurusan' => $request->jurusan,
                'nomor_sertifikat' => $request->nomor_sertifikat,
            ]);

             // URL untuk halaman show peserta
                $showUrl = route('pesertas.show', $peserta->id);

            return redirect()->route('pesertas.create')->with('success', 'Peserta berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('pesertas.create')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $peserta = Peserta::findOrFail($id);
        return view('admin.show-peserta', compact('peserta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $peserta = Peserta::findOrFail($id);
        return view('admin.edit-peserta', compact('peserta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:64',
            'ttl' => 'required|string|max:64',
            'sekolah' => 'required|string|max:64',
            'jurusan' => 'required|string|max:64',
            'nomor_sertifikat' => 'required|string|max:32|unique:pesertas,nomor_sertifikat,' . $id,
        ]);
        
        try {
            $peserta = Peserta::findOrFail($id);
            
            $peserta->update([
                'nama' => $request->nama,
                'ttl' => $request->ttl,
                'sekolah' => $request->sekolah,
                'jurusan' => $request->jurusan,
                'nomor_sertifikat' => $request->nomor_sertifikat,
            ]);

            return redirect()->route('pesertas.show', $peserta->id )->with('success', 'Peserta berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->route('pesertas.edit')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $peserta = Peserta::findOrFail($id);

            // Cari semua dokumen terkait berdasarkan nomor sertifikat
            $fileDokumens = FileDokumen::where('nomor_sertifikat', $peserta->nomor_sertifikat)->get();

            // Hapus file dan data dokumen jika ada
            foreach ($fileDokumens as $fileDokumen) {
                Storage::disk('public')->delete($fileDokumen->file_path);
                $fileDokumen->delete();
            }

            // Hapus data peserta
            $peserta->delete();

            DB::commit();

            return redirect()->route('pesertas.index')->with('success', 'Peserta berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pesertas.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
