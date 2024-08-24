<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'peserta_id' => 'required|exists:pesertas,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'nilai' => 'required|integer|max:100|min:75',
        ]);

        // Cek apakah kombinasi peserta dan kategori sudah ada
        $existingNilai = Nilai::where('peserta_id', $request->peserta_id)
            ->where('kategori_id', $request->kategori_id)
            ->first();

        if ($existingNilai) {
            return redirect()->back()->with('error', 'Nilai untuk kategori ini sudah ada.');
        }

        // Jika belum ada, simpan nilai baru
        Nilai::create([
            'peserta_id' => $request->peserta_id,
            'kategori_id' => $request->kategori_id,
            'nilai' => $request->nilai,
        ]);

        return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
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
        $kategori = Nilai::findOrFail($id);
        $kategori->delete();

        return redirect()->back()->with('success', 'Nilai berhasil dihapus');
    }
}
