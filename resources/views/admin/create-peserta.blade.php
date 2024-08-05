@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Input Data Peserta</h5>
                    <small class="text-muted float-end">Form Peserta</small>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pesertas.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Budiono Siregar" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="ttl">Tempat, Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ttl" name="ttl" placeholder="Mojokerto, 17 Agustus 2005" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="sekolah">Asal Sekolah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="sekolah" name="sekolah" placeholder="SMKN 1 Kapan Lawd" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="jurusan">Jurusan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Teknik Komputer dan Jaringan" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nomor_sertifikat">Nomor Sertifikat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nomor_sertifikat" name="nomor_sertifikat" placeholder="SMA-19/29321/1199" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="file_dokumen">Lembar Sertifikat</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="file_dokumen" name="file_dokumen" required>
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            <button type="reset" class="btn btn-outline-secondary">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
