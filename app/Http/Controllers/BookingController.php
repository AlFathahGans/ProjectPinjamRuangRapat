<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use DataTables;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Booking::with(['user', 'room', 'status', 'approval_status'])->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $edit = "
                    <button class='btn btn-sm btn-primary tooltip-position-bottom' onclick='edit_bookings({$row->id})' title='Edit'>
                        Edit
                    </button>";
                    $hapus = "
                    <button class='btn btn-sm btn-danger tooltip-position-bottom' onclick='hapus_bookings({$row->id})' title='Hapus'>
                        Hapus
                    </button>";
                    $aksi = "<div class='text-center'>".$edit." ".$hapus."</div>";
                    
                    return $aksi;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('bookings.index');
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'status_id' => 'required|exists:statuses,id',
            'approval_status_id' => 'required|exists:approval_statuses,id',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
        ]);

        Booking::create($validatedData);
        return response()->json(['success' => 'Booking saved successfully.']);
    }

    public function edit($id)
    {
        $booking = Booking::find($id);
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'status_id' => 'required|exists:statuses,id',
            'approval_status_id' => 'required|exists:approval_statuses,id',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
        ]);

        $booking = Booking::find($id);
        $booking->update($validatedData);
        return response()->json(['success' => 'Booking updated successfully.']);
    }

    public function destroy($id)
    {
        Booking::find($id)->delete();
        return response()->json(['success' => 'Booking deleted successfully.']);
    }
}
