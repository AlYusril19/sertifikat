@extends('layouts.app_sneat')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Upload Dokumen
        </div>
        <div class="card-body">

            <form action="{{ route('file_dokumen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nomor_sertifikat">Nomor Sertifikat</label>
                    <select name="nomor_sertifikat" id="nomor_sertifikat" class="form-control select2" required>
                        <option value="">Pilih Nomor Sertifikat</option>
                        @foreach($pesertas as $peserta)
                            <option value="{{ $peserta->nomor_sertifikat }}">{{ $peserta->nomor_sertifikat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="file_dokumen">File Dokumen</label>
                    <input type="file" name="file_dokumen" class="form-control-file" required>
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
