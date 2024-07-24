<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Obat::all();
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
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'stok' => 'required',
            'manfaat' => 'required|string',
        ]);

        $obat = Obat::create($validatedData);

        return response()->json($obat, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $obat = Obat::find($id);
        if (is_null($obat)) {
            return response()->json(['message' => 'Obat Tidak Ditemukan'], 404);
        }
        return response()->json($obat);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'stok' => 'sometimes|required',
            'manfaat' => 'sometimes|required|string',
        ]);

        $obat = Obat::find($id);
        if (is_null($obat)) {
            return response()->json(['message' => 'Obat Tidak Ditemukan'], 404);
        }

        $obat->update($validatedData);
        return response()->json($obat);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return response()->json(null, 204);
    }
}
