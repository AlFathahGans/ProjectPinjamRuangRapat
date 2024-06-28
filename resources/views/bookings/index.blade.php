@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="text-center">Pinjam/Booking Ruangan </h4>
                        <a href="{{ route('bookings.create') }}" class="btn btn-primary">Tambah Pinjam/Booking Ruangan</a>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success mt-2">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <table class="table table-bordered mt-2">
                            <tr class="table-dark">
                                <th>No</th>
                                <th>Room</th>
                                <th>Booked By</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th width="280px">Action</th>
                            </tr>
                            @php $no = 1; @endphp
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $booking->room->name }}</td>
                                    <td>{{ $booking->booked_by }}</td>
                                    <td>{{ $booking->start_time }}</td>
                                    <td>{{ $booking->end_time }}</td>
                                    <td>
                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                                            <a class="btn btn-primary"
                                                href="{{ route('bookings.edit', $booking->id) }}">Edit</a>
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
