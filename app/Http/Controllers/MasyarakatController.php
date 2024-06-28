<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masyarakat;
use PDF;

class MasyarakatController extends Controller
{
    public function index()
    {
        $masyarakat = Masyarakat::all();
        return view('masyarakat.index', compact('masyarakat'));
    }

    public function create()
    {
        return view('masyarakat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nomor_ktp' => 'required|unique:masyarakats',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dokumen' => 'nullable|mimes:pdf,doc,docx|max:2048', // Validasi untuk dokumen
        ]);

        $masyarakat = new Masyarakat();
        $masyarakat->nama = $request->nama;
        $masyarakat->alamat = $request->alamat;
        $masyarakat->nomor_ktp = $request->nomor_ktp;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $fileName, 'public');
            $masyarakat->foto = $fileName;
        }

        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('documents', $fileName, 'public');
            $masyarakat->dokumen = $fileName;
        }

        $masyarakat->save();

        return redirect()->route('masyarakat')->with('success', 'Data masyarakat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        return view('masyarakat.edit', compact('masyarakat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nomor_ktp' => 'required|unique:masyarakats,nomor_ktp,' . $id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dokumen' => 'nullable|mimes:pdf,doc,docx|max:2048', // Validasi untuk dokumen
        ]);

        $masyarakat = Masyarakat::findOrFail($id);

        $masyarakat->nama = $request->nama;
        $masyarakat->alamat = $request->alamat;
        $masyarakat->nomor_ktp = $request->nomor_ktp;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $fileName, 'public');
            $masyarakat->foto = $fileName;
        }

        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('documents', $fileName, 'public');
            $masyarakat->dokumen = $fileName;
        }

        $masyarakat->save();

        return redirect()->route('masyarakat')->with('success', 'Data masyarakat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        $masyarakat->delete();
        return redirect()->route('masyarakat')->with('success', 'Data masyarakat berhasil dihapus.');
    }

    public function pdf($id)
    {
        $masyarakat = Masyarakat::findOrFail($id);

        $data = [
            'masyarakat' => $masyarakat
        ];

        $pdf = PDF::loadView('masyarakat.pdf', $data);

        return $pdf->stream('ktp.pdf');
    }
}

