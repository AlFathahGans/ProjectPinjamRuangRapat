@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-3">Data Masyarakat</h5>
                    <div class="col-sm-6 mt-2 mb-2">
                        <a href="{{ route('masyarakat.create') }}" class="btn btn-success btn-sm"><i class="fa-solid fa-plus"></i> Tambah Data</a>
                    </div>
                    <table class="table table-sm table-hover">
                        <thead class="table-dark">
                            <tr>
                                <td>Nama</td>
                                <td>Alamat</td>
                                <td>Nomor KTP</td>
                                <td>Foto</td>
                                <td>Dokumen</td>
                                <td class="text-center">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($masyarakat as $orang)
                            <tr>
                                <td>{{ $orang->nama }}</td>
                                <td>{{ $orang->alamat }}</td>
                                <td>{{ $orang->nomor_ktp }}</td>
                                <td>
                                    @if($orang->foto)
                                        <img src="{{ asset('storage/uploads/' . $orang->foto) }}" alt="Foto" style="max-width: 50px;">
                                    @else
                                        Tidak ada foto
                                    @endif
                                </td>
                                <td>
                                    @if($orang->dokumen)
                                        <a href="{{ asset('storage/documents/' . $orang->dokumen) }}" target="_blank" class="btn btn-danger btn-sm"><i class="fa-solid fa-file"></i> Lihat Dokumen</a>
                                    @else
                                        Tidak ada dokumen
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('masyarakat.edit', $orang->id) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i> Edit</a>
                                    <form action="{{ route('masyarakat.destroy', $orang->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa-solid fa-trash"></i> Hapus</button>
                                    </form>
                                    <a href="{{ route('masyarakat.pdf', $orang->id) }}" class="btn btn-success btn-sm"><i class="fa-solid fa-print"></i> Cetak KTP</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
