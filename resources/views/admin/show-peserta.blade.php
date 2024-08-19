@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <h5 class="card-header">Detail Sertifikat Peserta</h5>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" value="{{ $peserta->nama }}" readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="sekolah">Asal Sekolah</label>
                    <input type="text" class="form-control" id="sekolah" value="{{ $peserta->sekolah }}" readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" value="{{ $peserta->jurusan }}" readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="ttl">Tempat Tanggal Lahir</label>
                    <input type="text" class="form-control" id="ttl" value="{{ $peserta->ttl }}" readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="nomor_sertifikat">Nomor Sertifikat</label>
                    <input type="text" class="form-control" id="nomor_sertifikat" value="{{ $peserta->nomor_sertifikat }}" readonly>
                </div>
                {{-- <div class="form-group mb-3">
                    <label for="file_dokumen">File Dokumen</label>
                    @if ($peserta->fileDokumen && Storage::disk('public')->exists($peserta->fileDokumen->file_path))
                        <a href="{{ asset('storage/' . $peserta->fileDokumen->file_path) }}" target="_blank" class="btn btn-primary">Lihat Dokumen</a>
                    @else
                        <p>Dokumen belum di upload.</p>
                    @endif
                </div> --}}
                <div class="mt-4">
                    <!-- Tampilkan gambar sertifikat dengan teks -->
                    @if(isset($uploadedImageUrl))
                        <div class="sertifikat">
                            {{-- <img src="{{ $uploadedImageUrl }}" alt="Sertifikat" class="img-fluid"> --}}
                            <img
                                src="{{ $uploadedImageUrl }}"
                                alt="e-sertifikat"
                                width="300" 
                                class="img-fluid"
                            />
                        </div>
                    @endif
                </div>
                <!-- Generate QR Code menggunakan Google Chart API -->
                <div class="mt-4">
                    <p>Bubuhkan Qr Code berikut ke Sertifikat Peserta</p>
                    {{-- <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{ route('public.pesertas.show', $peserta->id) }}" alt="QR Code"> --}}
                    <img src="https://quickchart.io/qr?text={{ route('public.pesertas.show', $peserta->id) }}&size=200" alt="Qr Code">
                </div>
                <p>
                    Jika Generate QR Code tidak muncul, silahkan copy link berikut dan convert menjadi qrcode <a href="{{ route('public.pesertas.show', $peserta->id) }}" target="_blank">link peserta</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
