<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $kategori = kategori::all();

        return view('produk/kategori')->with('kategori', $kategori);
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
            'kategori' => 'required|unique:kategoris,kategori,',
        ],[
                'kategori.required' => 'Kategori barang harus diisi.',
                'kategori.unique' => 'Kategori barang sudah ada.',
            ]
        );

        $kategori = new Kategori(); //untuk memanggil model kategori dari database
        $kategori->kategori = $validateData['kategori'];
        $kategori->save();
        return redirect()->route('kategori.index')->with('info-add', "$kategori->kategori berhasil ditambah");
    }

    /**
     * Display the specified resource.
     */
    public function show(kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validateData = $request->validate([
            'kategori' => 'required|unique:kategoris,kategori,'. $id,
        ], [
            'kategori.required' => 'Kategori barang harus diisi.',
            'kategori.unique' => 'Kategori barang sudah ada.',
        ]);

        $kategori = Kategori::find($id); //untuk mencari id kategori yang user ingin update
        $kategori->kategori = $validateData['kategori'];
        $kategori->save();

        return redirect()->route('kategori.index')->with('info-update', "$kategori->kategori berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //untuk menghapus dalam id kategori yang user ingin hapus
        $kategori = Kategori::find($id);
        $produk = Produk::where('kategori_id', $id)->first();
        if ($produk) {
            return redirect()->route('kategori.index')->with('info-delete', "Kategori $kategori->kategori  tidak dapat dihapus karena terdapat produk terkait.");
        } else {
            $kategori->delete();
            return redirect()->route('kategori.index')->with('info-delete', "$kategori->kategori berhasil dihapus");
        }
    }
}
