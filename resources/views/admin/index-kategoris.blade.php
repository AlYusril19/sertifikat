@extends('layouts.app_sneat')

@section('content')
    {{-- <h5 class="pb-1 mb-6">Data Peserta</h5> --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Kategori Nilai</h5>
            <a href="{{ route('kategoris.create') }}" class="btn btn-primary mb-0">Tambah Kategori</a>
        </div>
        <div class="row card-body">
            <div class="card col-md-6 mb-3">
                <table class="table table-bordered">
                    <caption class="ms-4">
                        Kategori Nilai Akademis
                    </caption>
                    <thead>
                        <tr align="center">
                            <th width="7%">No</th>
                            <th>Kategori Nilai</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($kategoriAkademis as $kategori)
                            <tr>
                                <td align="center"><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{ $loop->iteration }}</strong></td>
                                <td>{{ $kategori->nama }}</td>
                                <td>
                                    <form action="{{ route('kategoris.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card col-md-6 mb-3">
                <table class="table table-bordered">
                    <caption class="ms-4">
                        Kategori Nilai Non-Akademis
                    </caption>
                    <thead>
                        <tr align="center">
                            <th width="7%">No</th>
                            <th>Kategori Nilai</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($kategoriNonAkademis as $kategori)
                            <tr>
                                <td align="center"><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{ $loop->iteration }}</strong></td>
                                <td>{{ $kategori->nama }}</td>
                                <td>
                                    <form action="{{ route('kategoris.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr class="my-12">
@endsection
