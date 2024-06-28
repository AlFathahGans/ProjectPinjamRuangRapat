@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Tambah Data Masyarakat</div>

                <div class="card-body">
                    <form action="{{ route('masyarakat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nomor_ktp">Nomor KTP</label>
                            <input type="text" class="form-control @error('nomor_ktp') is-invalid @enderror" id="nomor_ktp" name="nomor_ktp" value="{{ old('nomor_ktp') }}">
                            @error('nomor_ktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control-file @error('foto') is-invalid @enderror" id="foto" name="foto">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="dokumen">Dokumen</label>
                            <input type="file" class="form-control-file @error('dokumen') is-invalid @enderror" id="dokumen" name="dokumen">
                            @error('dokumen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                       <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                        <a href="{{ route('masyarakat') }}" class="btn btn-secondary">Kembali</a>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
