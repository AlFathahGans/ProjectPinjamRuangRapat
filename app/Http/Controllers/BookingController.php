<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('room')->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('bookings.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required',
            'booked_by' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        Booking::create($request->all());
        return redirect()->route('bookings.index')
                         ->with('success', 'Booking created successfully.');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $rooms = Room::all();
        return view('bookings.edit', compact('booking', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'room_id' => 'required',
            'booked_by' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update($request->all());
        return redirect()->route('bookings.index')
                         ->with('success', 'Booking updated successfully.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('bookings.index')
                         ->with('success', 'Booking deleted successfully.');
    }
}
