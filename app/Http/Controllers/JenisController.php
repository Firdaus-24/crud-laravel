<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('jenis.index', ['data' => Jenis::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'txtnama' => 'required|unique:kategoris,nama|min:3|max:30'
        ]);


        Jenis::create([
            'nama' => strtoupper($request->txtnama),
            'is_active' => 1
        ]);

        return back()->with('success', 'data berhasil di simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenis $jenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jenis $jenis, $id)
    {
        $data = $jenis->findOrFail($id);
        return response()->json([
            'id' => $data->id,
            'nama' => $data->nama
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jenis $jenis)
    {
        $data = Jenis::find($request->id);
        $request->validate([
            'txtnama' => 'required|unique:jenis,nama|min:3|max:30'
        ]);
        $data->nama = strtoupper($request->txtnama);

        $data->save();

        return back()->with('success', 'data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis $jenis, $id)
    {
        Jenis::destroy($id);
        return back()->with('success', 'data berhasil di hapus');
    }
}
