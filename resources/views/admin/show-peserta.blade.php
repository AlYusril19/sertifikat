@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            {{-- <h5 class="card-header">Detail Sertifikat Peserta</h5> --}}
            <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Sertifikat Peserta</h5>
                    <a href="{{ route('public.pesertas.show', $peserta->id) }}" class="btn btn-primary" target="_blank">Preview <i class="bx bx-show-alt me-1"></i></a>
                </div>
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
                <div class="form-group mb-3">
                    <label for="periode_magang">Periode Magang</label>
                    <input type="text" class="form-control" id="periode_magang" 
                        value="{{ $peserta->tanggal_masuk->isoFormat('D MMMM Y') }}  -  {{ $peserta->tanggal_keluar->isoFormat('D MMMM Y') }}" readonly>
                </div>

                <div class="form-group mb-1">
                    <label for="file_dokumen">File Dokumen</label><br>
                    @if ($peserta->fileDokumen && Storage::disk('public')->exists($peserta->fileDokumen->file_path))
                        {{-- <a href="{{ asset('storage/' . $peserta->fileDokumen->file_path) }}" target="_blank" class="btn btn-primary">Lihat Dokumen</a> --}}
                        <img
                            src="{{ Storage::url($peserta->fileDokumen->file_path) }}"
                            alt="e-sertifikat"
                            width="150" 
                            class="img-fluid"
                        />
                    @else
                        <input type="text" class="form-control" id="file_dokumen" 
                        value="Sertifikat belum di upload / generate" readonly>
                    @endif
                </div>

                <div class="mb-3">
                    @if ($peserta->fileDokumen && Storage::disk('public')->exists($peserta->fileDokumen->file_path))
                        <p>Sertifikat sudah di upload. ✅</p>
                    @else
                        <div class="mt-3">
                            <a href="{{ route('pesertas.generate', $peserta->id) }}" class="btn btn-primary" onclick="refreshAfterDownload()">
                                Generate Sertifikat
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Generate QR Code menggunakan Google Chart API -->
                <div class="mt-4">
                    <div class="alert alert-dark" role="alert">
                        Jika Generate Sertifikat GAGAL, silahkan buka link berikut <strong>
                        <a href="https://quickchart.io/qr?text={{ route('public.pesertas.show', $peserta->id) }}&size=200" target="_blank">
                            link qrcode
                        </a></strong>, dan bubuhkan ke sertifikat secara manual!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function refreshAfterDownload() {
        // Beri jeda untuk memastikan unduhan dimulai sebelum refresh
        setTimeout(function() {
            window.location.reload();
        }, 17000); // Anda bisa menyesuaikan waktu delay
    }
</script>