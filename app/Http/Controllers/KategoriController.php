<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        // Ambil semua kategori dari database
        $kategoriAkademis = Kategori::where('kategori', 'Akademis')->get();
        $kategoriNonAkademis = Kategori::where('kategori', 'Non-Akademis')->get();
        return view('admin.index-kategoris', compact('kategoriAkademis','kategoriNonAkademis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Daftar kategori utama yang diperbolehkan
        $allowedKategori = [
            'Akademis',
            'Non-Akademis',
        ];
        return view('admin.create-kategori', compact('allowedKategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Daftar kategori utama yang diperbolehkan
        $allowedKategori = [
            'Akademis',
            'Non-Akademis',
        ];
        $request->validate([
            'kategori' => ['required', Rule::in($allowedKategori)],
            'nama' => 'required|string|max:64|unique:kategoris',
        ]);

        Kategori::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('kategoris.create')->with('success', 'Kategori berhasil ditambahkan');
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
        $kategori = Kategori::findOrFail($id);
        $allowedKategori = [
            'Akademis',
            'Non-Akademis',
        ];
        return view('admin.edit-kategori', compact('kategori', 'allowedKategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Daftar kategori utama yang diperbolehkan
        $allowedKategori = [
            'Akademis',
            'Non-Akademis',
        ];
        
        $request->validate([
            'kategori' => ['required', Rule::in($allowedKategori)],
            // Tambahkan pengecualian ID saat melakukan validasi unik
            'nama' => ['required', 'string', 'max:64', Rule::unique('kategoris')->ignore($id)],
        ]);

        try {
            $kategori = Kategori::findOrFail($id);

            $kategori->update([
                'nama' => $request->nama,
                'kategori' => $request->kategori,
            ]);

            return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->route('kategoris.edit', $id)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        if ($kategori->nilai()->exists()) {
            return redirect()->route('kategoris.index')->with('error', 'Kategori tidak dapat dihapus karena memiliki nilai terkait.');
        }
        $kategori->delete();

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dihapus');
    }
}
