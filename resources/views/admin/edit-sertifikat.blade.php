@extends('layouts.app_sneat')

@section('content')
{{-- <div class="container">
    <h1>Edit Sertifikat</h1>

    <form action="{{ route('file_dokumen.update', $sertifikat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nomor_sertifikat">Nomor Sertifikat</label>
            <input type="text" name="nomor_sertifikat" id="nomor_sertifikat" class="form-control" value="{{ old('nomor_sertifikat', $sertifikat->nomor_sertifikat) }}" required>
        </div>

        <div class="form-group">
            <label for="file_path">Path File Dokumen</label>
            <input type="text" name="file_path" id="file_path" class="form-control" value="{{ old('file_path', $sertifikat->file_path) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div> --}}

<div class="container">
    <div class="card">
        <div class="card-header">
            Edit Dokumen
        </div>
        <div class="card-body">

            <form action="{{ route('file_dokumen.update', $sertifikat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nomor_sertifikat">Nomor Sertifikat</label>
                    <select name="nomor_sertifikat" id="nomor_sertifikat" class="form-control select2" required>
                        <option value="{{ old('nomor_sertifikat', $sertifikat->nomor_sertifikat) }}">{{ $sertifikat->nomor_sertifikat }}</option>
                        {{-- @foreach($pesertas as $peserta)
                            <option value="{{ $peserta->nomor_sertifikat }}">{{ $peserta->nomor_sertifikat }} | {{ $peserta->nama }}</option>
                        @endforeach --}}
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label for="file_path">File Dokumen</label>
                    <input type="file" name="file_path" class="form-control-file" required>
                </div>

                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
