@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Selamat Datang {{ Auth::user()->name }} 🎉</h5>
                        <p class="mb-4">
                            Ada <span class="fw-bold">{{ $peserta }}</span> Peserta yang belum dapat sertifikat
                        </p>
                        <a href="{{ route('file_dokumen.create') }}" class="btn btn-sm btn-outline-primary">Tambah Sertifikat</a>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="{{ asset('sneat') }}/assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
