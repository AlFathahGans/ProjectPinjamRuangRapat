@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="text-center">Form Edit Pinjam/Booking Ruangan</h4>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Room:</strong>
                    <select name="room_id" class="form-control">
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ $booking->room_id == $room->id ? 'selected' : '' }}>
                                {{ $room->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Booked By:</strong>
                    <input type="text" name="booked_by" value="{{ $booking->booked_by }}" class="form-control" placeholder="Booked By">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Start Time:</strong>
                    <input type="datetime-local" name="start_time" value="{{ $booking->start_time->format('Y-m-d\TH:i') }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mb-2">
                <div class="form-group">
                    <strong>End Time:</strong>
                    <input type="datetime-local" name="end_time" value="{{ $booking->end_time->format('Y-m-d\TH:i') }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
