<?php

namespace App\Http\Controllers;

use App\Models\FileDokumen;
use App\Models\Peserta;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pesertas = Peserta::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                            ->orWhere('nomor_sertifikat', 'like', "%{$search}%");
            })
            ->paginate(10); // Menggunakan paginate untuk hasil per halaman

        // $pesertas = Peserta::all();
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

            return redirect()->route('pesertas.index')->with('success', 'Peserta berhasil ditambahkan');
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

        $qrCodeUrl = "https://quickchart.io/qr?text=" . route('public.pesertas.show', $peserta->id) . "&size=200";

        // Mengunduh gambar QR Code dari URL
        $client = new Client();
        $response = $client->get($qrCodeUrl);

        // Simpan gambar QR Code sementara
        $tempFile = 'qr_code.png';
        file_put_contents($tempFile, $response->getBody());

        // Upload gambar QR Code ke Cloudinary
        $uploadedImage = Cloudinary::upload($tempFile, [
            'folder' => 'qrcodes', // Folder di Cloudinary untuk menyimpan gambar
        ]);

        // Ambil URL gambar QR Code yang telah di-upload
        $qrCodeUrl = $uploadedImage->getSecurePath();

        // Format tanggal
        $dateCreated = $peserta->created_at; // Gunakan tanggal yang sesuai jika berbeda
        $tanggalBuat = urldecode("Mojokerto, ") . $dateCreated->format('j F Y'); // Format: 19 September 2019

        // Tentukan path gambar template sertifikat
        $templatePath = public_path('img/template_sertifikat.png');

        // Pastikan template path ada
        if (!file_exists($templatePath)) {
            return redirect()->route('pesertas.index')->with('error', 'Template sertifikat tidak ditemukan.');
        }

        // Generate teks untuk ditambahkan ke gambar (misalnya nama peserta)
        $nama = $peserta->nama;  // Sesuaikan teks yang ingin ditampilkan
        $no_sertifikat = $peserta->nomor_sertifikat;

        try {
            // Upload gambar ke Cloudinary dengan overlay teks
            $uploadedImageUrl = Cloudinary::upload($templatePath, [
                'transformation' => [
                    [
                        'overlay' => [
                            'font_family' => 'Times New Roman',
                            'font_size' => 50,
                            'text' => \urldecode($no_sertifikat),
                        ],
                        'y' => -200,
                    ],
                    [
                        'overlay' => [
                            'font_family' => 'Times New Roman',
                            'font_size' => 115,
                            'text' => $nama,
                            'gravity' => 'center',
                            'font_weight' => 'bold',
                        ],
                        'color' => '#005C82',
                        'y' => 30,
                    ],

                    [
                        'overlay' => [
                            'font_family' => 'Arial',
                            'font_size' => 42,
                            'text' => "Telah melaksanakan Praktek Kerja Lapangan (Prakerin) \ndi PT. SKYNET MEDIA UTAMA",
                            'text_align' => 'center',
                        ],
                        'y' => 200,
                    ],

                    [
                        'overlay' => [
                            'font_family' => 'Arial',
                            'font_size' => 42,
                            'text' => $tanggalBuat,
                            // 'text_align' => 'center',
                        ],
                        'gravity' => 'south',
                        'y' => 600,
                    ],

                    [
                        'overlay' => [
                            'url' => $qrCodeUrl,
                        ],
                        'gravity' => 'south',
                        'width' => 260,
                        'height' => 260,
                        'y' => 300, // Jarak dari tepi bawah
                    ]

                ]
            ])->getSecurePath();

            // Hapus file QR Code sementara
            unlink($tempFile);

            return view('admin.show-peserta', compact('peserta', 'uploadedImageUrl'));
        } catch (\Exception $e) {
            return redirect()->route('pesertas.index')->with('error', 'Terjadi kesalahan saat mengupload gambar: ' . $e->getMessage());
        }
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
