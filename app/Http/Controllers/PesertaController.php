<?php

namespace App\Http\Controllers;

use App\Models\FileDokumen;
use App\Models\Peserta;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;

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
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date',
            'nomor_sertifikat' => 'nullable|string|max:32|unique:pesertas,nomor_sertifikat',
        ]);

        try {
            $peserta = Peserta::create([
                'nama' => $request->nama,
                'ttl' => $request->ttl,
                'sekolah' => $request->sekolah,
                'jurusan' => $request->jurusan,
                'tanggal_masuk' => $request->tanggal_masuk,
                'tanggal_keluar' => $request->tanggal_keluar,
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
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date',
            'nomor_sertifikat' => 'required|string|max:32|unique:pesertas,nomor_sertifikat,' . $id,
        ]);
        
        try {
            $peserta = Peserta::findOrFail($id);
            
            $peserta->update([
                'nama' => $request->nama,
                'ttl' => $request->ttl,
                'sekolah' => $request->sekolah,
                'jurusan' => $request->jurusan,
                'tanggal_masuk' => $request->tanggal_masuk,
                'tanggal_keluar' => $request->tanggal_keluar,
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

    public function generate(string $id)
    {
        $peserta = Peserta::findOrFail($id);

        $qrCodeUrl = "https://quickchart.io/qr?text=" . urlencode(route('public.pesertas.show', $peserta->id)) . "&size=200";

        // Mengunduh gambar QR Code dari URL
        $client = new Client();
        $response = $client->get($qrCodeUrl);

        // Simpan gambar QR Code sementara
        $tempFile = 'qr_code.png';
        file_put_contents($tempFile, $response->getBody());

        // Upload gambar QR Code ke Cloudinary
        $uploadedImage = Cloudinary::upload($tempFile, [
            'folder' => 'qrcodes',
        ]);

        $qrCodeUrl = $uploadedImage->getSecurePath();
        $qrCodeUrlPublicId = $uploadedImage->getPublicId();

        // Atur lokalitas ke Indonesia
        Carbon::setLocale('id');

        // Format tanggal
        $dateCreated = $peserta->created_at->isoFormat('D MMMM Y');
        $tanggalMasuk = $peserta->tanggal_masuk->isoFormat('D MMMM Y');
        $tanggalKeluar = $peserta->tanggal_keluar->isoFormat('D MMMM Y');

        // Tentukan path gambar template sertifikat
        $templatePath = public_path('img/template_sertifikat.png');

        if (!file_exists($templatePath)) {
            return redirect()->route('pesertas.index')->with('error', 'Template sertifikat tidak ditemukan.');
        }

        $nama = $peserta->nama;
        $noSertifikat = str_replace('/', " \u{0338} ", $peserta->nomor_sertifikat);
        $tanggalBuat = str_replace(',', "\u{201A}", "Mojokerto, $dateCreated");
        $periodeMagang = "Periode $tanggalMasuk - $tanggalKeluar";

        try {
            $uploadResult = Cloudinary::upload($templatePath, [
                'transformation' => [
                    [
                        'overlay' => [
                            'font_family' => 'Times New Roman',
                            'font_size' => 50,
                            'text' => $noSertifikat,
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
                            'text' => $periodeMagang,
                            'gravity' => 'center',
                        ],
                        'y' => 272,
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
                        ],
                        'gravity' => 'south',
                        'y' => 590,
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
            ]);

            $lembarSertifikatUrl = $uploadResult->getSecurePath();
            $lembarSertifikatPublicId = $uploadResult->getPublicId();

            unlink($tempFile); // Hapus file sementara

            // Unduh gambar dari Cloudinary dan simpan ke public/documents menggunakan store()
            $tempLocalFile = tempnam(sys_get_temp_dir(), 'certificate');
            file_put_contents($tempLocalFile, file_get_contents($lembarSertifikatUrl));

            // Gunakan store() untuk menyimpan ke direktori public/documents
            $filePath = Storage::disk('public')->putFile('documents', new \Illuminate\Http\File($tempLocalFile));

            // Simpan path file ke database
            FileDokumen::create([
                'nomor_sertifikat' => $peserta->nomor_sertifikat,
                'file_path' => $filePath,
            ]);

            Cloudinary::destroy($lembarSertifikatPublicId);
            Cloudinary::destroy($qrCodeUrlPublicId);

            // Stream download gambar dan setelah selesai, hapus dari Cloudinary
            // return response()->streamDownload(function() use ($lembarSertifikatUrl, $lembarSertifikatPublicId, $qrCodeUrlPublicId) {
            //     echo file_get_contents($lembarSertifikatUrl);
            //     // Hapus file dari Cloudinary setelah stream selesai
            //     Cloudinary::destroy($lembarSertifikatPublicId);
            //     Cloudinary::destroy($qrCodeUrlPublicId);
            // }, 'sertifikat_'.$peserta->nama.'.png');
            
            // Download file dan hapus file setelah didownload
            return response()->download(storage_path("app/public/{$filePath}"), 'sertifikat_'."$peserta->nama".'.png');
            // return redirect()->route('pesertas.show', $peserta->id )->with('success', 'Peserta berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->route('pesertas.index')->with('error', 'Terjadi kesalahan saat mengupload gambar: ' . $e->getMessage());
        }
    }

}
