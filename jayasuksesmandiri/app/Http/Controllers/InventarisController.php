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
    public function index() //untuk menampilkan halaman inventaris
    {
        //
        $kategoris = Kategori::all(); //model mengambil database kategori
        $inventaris = Inventaris::all(); ////model mengambil database inventaris
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
        $validateData = $request->validate([ //validasi menyimpan data transaksi
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'jumlah_stok' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'satuan' => 'required',
        ]);

        $inventaris = new Inventaris(); //sebagai objek data dari inventaris
        $inventaris->nama_barang = $validateData['nama_barang'];
        $inventaris->kategori_id = $validateData['kategori_id'];
        $inventaris->jumlah_stok = $validateData['jumlah_stok'];
        $inventaris->harga_beli = $validateData['harga_beli'];
        $inventaris->harga_jual = $validateData['harga_jual'];
        $inventaris->satuan = $validateData['satuan'];

        $inventaris->save();
        return redirect()->route('inventaris.index')->with("info-add", "Barang $inventaris->nama_barang berhasil ditambah");
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,Inventaris $inventaris)
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
    public function update(Request $request, $id)
    {
        //fungsi untuk mengupdate data melalui form inventaris
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'jumlah_stok' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'satuan' => 'required',
        ]);
        $inventaris = Inventaris::find($id); //untuk mengambil id yang user edit
        $inventaris->nama_barang = $validatedData['nama_barang'];
        $inventaris->kategori_id = $validatedData['kategori_id'];
        $inventaris->jumlah_stok = $validatedData['jumlah_stok'];
        $inventaris->harga_beli = $validatedData['harga_beli'];
        $inventaris->harga_jual = $validatedData['harga_jual'];
        $inventaris->satuan = $validatedData['satuan'];

        $inventaris->save();
        return redirect()->route('inventaris.index')->with('info-update', "Barang $inventaris->nama_barang berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //untuk menghapus dalam id inventaris yang user ingin hapus
        $inventaris = Inventaris::find($id);
        $inventaris->delete();
        return redirect()->route('inventaris.index')->with('info-delete', "Barang $inventaris->nama_barang berhasil dihapus");
    }
}
