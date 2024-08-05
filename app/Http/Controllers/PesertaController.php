<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
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
            'file_dokumen' => 'required|file|mimes:pdf,doc,docx,png|max:2048',
            'nomor_sertifikat' => 'nullable|string|max:32|unique:pesertas,nomor_sertifikat',
        ]);

        try {
            // Menyimpan file dokumen
            $filePath = $request->file('file_dokumen')->store('documents');

            Peserta::create([
                'nama' => $request->nama,
                'ttl' => $request->ttl,
                'sekolah' => $request->sekolah,
                'jurusan' => $request->jurusan,
                'file_dokumen' => $filePath,
                'nomor_sertifikat' => $request->nomor_sertifikat,
            ]);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
