@extends('layouts.app_sneat')

@section('content')
<div class="card">
                <h5 class="card-header">Data Peserta</h5>
                <div class="table-responsive text-nowrap">
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
                    <tbody>
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
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('pesertas.show', $peserta->id) }}"><i class="bx bx-show-alt me-1"></i> Show</a>
                                        <a class="dropdown-item" href="{{ route('pesertas.edit', $peserta->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form action="{{ route('pesertas.destroy', $peserta->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta ini?');" style="display:inline;">
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
                </div>
            </div>
@endsection
