@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="text-center">Data Ruangan</h4>
                        <a href="{{ route('rooms.create') }}" class="btn btn-primary">Tambah Ruangan</a>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success mt-2">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <table class="table table-bordered mt-2">
                            <tr class="table-dark">
                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th width="280px">Action</th>
                            </tr>
                            @php $no = 1; @endphp
                            @foreach ($rooms as $room)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $room->name }}</td>
                                    <td>{{ $room->description }}</td>
                                    <td>
                                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST">
                                            <a class="btn btn-primary" href="{{ route('rooms.edit', $room->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
