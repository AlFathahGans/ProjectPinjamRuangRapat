<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use DataTables;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rooms = Room::all();
            return datatables()->of($rooms)
                ->addColumn('action', function ($row) {
                    $edit = "
                    <button class='btn btn-sm btn-primary tooltip-position-bottom' onclick='edit_rooms({$row->id})' title='Edit'>
                        Edit
                    </button>";
                    $hapus = "
                    <button class='btn btn-sm btn-danger tooltip-position-bottom' onclick='hapus_rooms({$row->id})' title='Hapus'>
                        Hapus
                    </button>";
                    $aksi = "<div class='text-center'>".$edit." ".$hapus."</div>";

                    return $aksi;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('rooms.index');
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'is_available' => 'required|boolean',
        ]);

        Room::create($request->all());

        return response()->json(['success' => 'Room created successfully.']);
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'is_available' => 'required|boolean',
        ]);

        $room = Room::findOrFail($id);
        $room->update($request->all());

        return response()->json(['success' => 'Room updated successfully.']);
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return response()->json(['success' => 'Room deleted successfully.']);
    }
}
