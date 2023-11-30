<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Barangs;
use App\Models\Kategoris;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;

class BarangsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('barangs.index', ['data' => Barangs::with('kategoris', 'jenis')->get(), 'kategoris' => Kategoris::all(), 'jeniss' => Jenis::all()]);
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
            'txtnama' => 'required|unique:barangs,nama|min:3|max:30',
            'txtkategori' => 'required',
            'txtjenis' => 'required'
        ]);


        Barangs::create([
            'nama' => strtoupper($request->txtnama),
            'kategori_id' => $request->txtkategori,
            'jenis_id' => $request->txtjenis,
            'is_active' => 1
        ]);

        return back()->with('success', 'data berhasil di simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barangs $barangs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barangs $barangs, $id)
    {
        $data = $barangs->findOrFail($id);
        return response()->json([
            'id' => $data->id,
            'nama' => $data->nama,
            'kategori' => $data->kategori_id,
            'jenis' => $data->jenis_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barangs $barangs)
    {
        $data = Barangs::find($request->id);
        $request->validate([
            'txtnama' => 'required|unique:barangs,nama|min:3|max:30',
            'txtkategori' => 'required',
            'txtjenis' => 'required'
        ]);
        $data->nama = strtoupper($request->txtnama);
        $data->kategori_id = $request->txtkategori;
        $data->jenis_id = $request->txtjenis;

        $data->save();

        return back()->with('success', 'data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barangs $barangs, $id)
    {
        Barangs::destroy($id);
        return back()->with('success', 'data berhasil di hapus');
    }


    public function getAllBarangs()
    {
        $data = Barangs::with('kategoris', 'jenis')->get();
        return response()->json($data, 200);
    }

    public function storeBarangs(Request $request)
    {
        $rules = array(
            'nama' => 'required|unique:barangs,nama|min:3|max:30',
            'kategori' => 'required',
            'jenis' => 'required'
        );
        $valid = Validator::make($request->all(), $rules);

        if ($valid->fails()) {
            return $valid->errors();
        } else {
            Barangs::create([
                'nama' => strtoupper($request->nama),
                'kategori_id' => $request->kategori,
                'jenis_id' => $request->jenis,
                'is_active' => 1
            ]);

            return response()->json([
                'massage' => 'data berhasil di simpan'
            ], 500);
        }
    }

    public function updateBarangs(Request $request)
    {
        $data = Barangs::find($request->id);
        if (!$data) {
            return response()->json(['message' => 'Data tidak terdaftar'], 404);
        }
        $rules = array(
            'nama' =>  [
                'required',
                'min:3',
                'max:50',
                Rule::unique('barangs', 'nama')->ignore($request->id, 'id')
            ],
            'kategori' => 'required',
            'jenis' => 'required'
        );

        $valid = Validator::make($request->all(), $rules);
        if ($valid->fails()) {
            return $valid->errors();
        } else {

            $data->nama = strtoupper($request->nama);
            $data->kategori_id = $request->kategori;
            $data->jenis_id = $request->jenis;

            $data->save();

            return response()->json(['message' => 'Data berhasil diupdate'], 500);
        }
    }

    public function deleteBarangs(Request $request)
    {
        $data = Barangs::find($request->id);

        if ($data) {
            Barangs::destroy($request->id);
            return response()->json(['message' => 'Data berhasil hapus'], 500);
        } else {
            return response()->json(['message' => 'Data tidak terdaftar'], 404);
        }
    }
}
