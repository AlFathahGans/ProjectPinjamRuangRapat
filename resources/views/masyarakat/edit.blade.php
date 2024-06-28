@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Data Masyarakat</div>
                <div class="card-body">
                    <form action="{{ route('masyarakat.update', $masyarakat->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ $masyarakat->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $masyarakat->alamat }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor_ktp">Nomor KTP:</label>
                            <input type="text" name="nomor_ktp" id="nomor_ktp" class="form-control" value="{{ $masyarakat->nomor_ktp }}" required>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto:</label>
                            <input type="file" name="foto" id="foto" class="form-control mb-2">
                            @if($masyarakat->foto)
                                <img src="{{ asset('storage/uploads/' . $masyarakat->foto) }}" alt="Foto" style="max-width: 100px;">
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="dokumen">Dokumen:</label>
                            <input type="file" name="dokumen" id="dokumen" class="form-control">
                            @if($masyarakat->dokumen)
                                <a href="{{ asset('storage/documents/' . $masyarakat->dokumen) }}" target="_blank" class="btn btn-danger btn-sm mt-3">Lihat Dokumen</a>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('masyarakat') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
