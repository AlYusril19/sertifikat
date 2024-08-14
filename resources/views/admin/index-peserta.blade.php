@extends('layouts.app_sneat')

@section('content')
    <h5 class="pb-1 mb-6">Data Peserta</h5>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            {{-- <h5 class="mb-0">Daftar Peserta</h5> --}}
            <a href="{{ route('pesertas.create') }}" class="btn btn-primary mb-0">Tambah Peserta</a>
            <div class=" align-items-center">
                <form action="{{ route('pesertas.index') }}" method="GET" class="d-flex me-2">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari Peserta" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
        </div>
        <div class="text-nowrap table-responsive">
            <table class="table">
                <caption class="ms-4">
                    Data Sertifikat
                </caption>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Sekolah</th>
                        <th>Jurusan</th>
                        <th>Sertifikat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($pesertas as $peserta)
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $peserta->nama }}</strong></td>
                            <td>{{ $peserta->sekolah }}</td>
                            <td>{{ $peserta->jurusan }}</td>
                            <td>{{ $peserta->nomor_sertifikat }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    {{-- <div class="dropdown-menu show" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(1044.8px, 319.2px, 0px);" data-popper-placement="bottom-start"> --}}
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('pesertas.show', $peserta->id) }}"><i class="bx bx-show-alt me-2"></i> Show</a>
                                        <a class="dropdown-item" href="{{ route('pesertas.edit', $peserta->id) }}"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                        <form action="{{ route('pesertas.destroy', $peserta->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pesertas->links() }}
        </div>
    </div>
    <hr class="my-12">
@endsection
