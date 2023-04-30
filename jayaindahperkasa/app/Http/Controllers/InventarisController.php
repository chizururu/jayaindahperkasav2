<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $kategoris = Kategori::all();
        $inventaris = Inventaris::all();
        return view('inventaris.index')->with('inventaris', $inventaris)->with('kategoris', $kategoris);
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
            'kategori_id' => 'required',
            'jumlah_stok' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'satuan' => 'required',
        ]);

        $inventaris = new Inventaris();
        $inventaris->nama_barang = $validateData['nama_barang'];
        $inventaris->kategori_id = $validateData['kategori_id'];
        $inventaris->jumlah_stok = $validateData['jumlah_stok'];
        $inventaris->harga_beli = $validateData['harga_beli'];
        $inventaris->harga_jual = $validateData['harga_jual'];
        $inventaris->satuan = $validateData['satuan'];

        $inventaris->save();
        return redirect()->route('inventaris.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventaris $inventaris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventaris $inventaris)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventaris $inventaris)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $inventaris = Inventaris::find($id);
        $inventaris->delete();
        return redirect()->route('inventaris.index');
    }
}
