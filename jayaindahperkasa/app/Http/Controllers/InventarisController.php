<?php

namespace App\Http\Controllers;

use App\Models\inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $inventaris = inventaris::all();
        return view('inventaris.index')->with('inventaris', $inventaris);
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
        //
        $validateData = $request->validate([
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'jumlah_stok' => 'required',
            'harga_satuan' => 'required',
            'harga_jual' => 'required',
            'satuan' => 'required',
        ]);

        $inventaris = new inventaris();
        $inventaris->nama_barang = $validateData['nama_barang'];
        $inventaris->kategori_barang = $validateData['kategori_barang'];
        $inventaris->jumlah_stok = $validateData['jumlah_stok'];
        $inventaris->harga_satuan = $validateData['harga_satuan'];
        $inventaris->harga_jual = $validateData['harga_jual'];
        $inventaris->satuan = $validateData['satuan'];

        $inventaris->save();
        return redirect()->route('inventaris.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(inventaris $inventaris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(inventaris $inventaris)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, inventaris $inventaris)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $inventaris = inventaris::find($id);
        $inventaris->delete();
        return redirect()->route('inventaris.index');
    }
}
