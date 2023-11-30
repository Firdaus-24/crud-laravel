<?php

namespace App\Http\Controllers;

use App\Models\Kategoris;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;

class KategorisController extends Controller
{

    public function index()
    {
        return view('kategoris.index', ['data' => Kategoris::all()]);
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


        Kategoris::create([
            'nama' => strtoupper($request->txtnama),
            'is_active' => 1
        ]);

        return back()->with('success', 'data berhasil di simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategoris $kategoris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategoris $kategoris, $id)
    {
        $data = $kategoris->findOrFail($id);
        return response()->json([
            'id' => $data->id,
            'nama' => $data->nama
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategoris $kategoris)
    {
        $data = Kategoris::find($request->id);
        $request->validate([
            'txtnama' => 'required|unique:kategoris,nama|min:3|max:30'
        ]);
        $data->nama = strtoupper($request->txtnama);

        $data->save();

        return back()->with('success', 'data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategoris $kategoris, $id)
    {
        Kategoris::destroy($id);
        return back()->with('success', 'data berhasil di hapus');
    }


    public function getAllKategoris()
    {
        $data = Kategoris::all();
        return response()->json($data, 200);
    }

    public function storeKategoris(Request $request)
    {
        $rules = array(
            'nama' => 'required|unique:kategoris,nama|min:3|max:30',
        );
        $valid = Validator::make($request->all(), $rules);

        if ($valid->fails()) {
            return $valid->errors();
        } else {
            Kategoris::create([
                'nama' => strtoupper($request->nama),
                'is_active' => 1
            ]);

            return response()->json([
                'massage' => 'data berhasil di simpan'
            ], 500);
        }
    }

    public function updateKategoris(Request $request)
    {
        $data = Kategoris::find($request->id);
        if (!$data) {
            return response()->json(['message' => 'Data tidak terdaftar'], 404);
        }
        $rules = array(
            'nama' =>  [
                'required',
                'min:3',
                'max:50',
                Rule::unique('Kategoris', 'nama')->ignore($request->id, 'id')
            ],
        );

        $valid = Validator::make($request->all(), $rules);
        if ($valid->fails()) {
            return $valid->errors();
        } else {

            $data->nama = strtoupper($request->nama);

            $data->save();

            return response()->json(['message' => 'Data berhasil diupdate'], 500);
        }
    }

    public function deleteKategoris(Request $request)
    {
        $data = Kategoris::find($request->id);

        if ($data) {
            Kategoris::destroy($request->id);
            return response()->json(['message' => 'Data berhasil hapus'], 500);
        } else {
            return response()->json(['message' => 'Data tidak terdaftar'], 404);
        }
    }
}
