<?php

namespace App\Http\Controllers;

use App\Models\FileDokumen;
use App\Models\Peserta;
use Illuminate\Http\Request;

class FileDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        {
            $pesertas = Peserta::all(); // Mengambil semua data peserta
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

        return redirect()->route('admin.sertifikat')->with('success', 'Dokumen berhasil diupload');
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
