@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Data Peserta</h5>
                    <small class="text-muted float-end">Form Edit Peserta</small>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pesertas.update', $peserta->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $peserta->nama }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="ttl">Tempat, Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ttl" name="ttl" value="{{ $peserta->ttl }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="sekolah">Asal Sekolah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="sekolah" name="sekolah" value="{{ $peserta->sekolah }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="jurusan">Jurusan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="jurusan" name="jurusan" value="{{ $peserta->jurusan }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nomor_sertifikat">Nomor Sertifikat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nomor_sertifikat" name="nomor_sertifikat" value="{{ $peserta->nomor_sertifikat }}" required>
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="file_dokumen">Lembar Sertifikat</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="file_dokumen" name="file_dokumen">
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                            </div>
                            <div class="col-sm-10 mt-2">
                                <img src="{{ asset('storage/' . $peserta->file_dokumen) }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                            </div>
                        </div> --}}
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
