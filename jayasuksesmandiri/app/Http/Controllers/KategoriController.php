<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() //untuk menampilkan halaman index kategori
    {
        //
        $kategori = Kategori::all();
        return view('kategori.index')->with('kategori', $kategori);
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
        //untuk menyimpan data kategori barang dalam database
        $validateData = $request->validate([
            'kategori' => 'required',
            'deskripsi' => 'required',
        ]);

        $kategori = new Kategori(); //untuk memanggil model kategori dari database
        $kategori->kategori = $validateData['kategori'];
        $kategori->deskripsi = $validateData['deskripsi'];
        $kategori->save();

        return redirect()->route('kategori.index')->with('info-add', "$kategori->kategori berhasil ditambah");
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //untuk menyimpan data yang telah diupdate
        $validateData = $request->validate([
            'kategori' => 'required',
            'deskripsi' => 'required',
        ]);

        $kategori = Kategori::find($id); //untuk mencari id kategori yang user ingin update
        $kategori->kategori = $validateData['kategori'];
        $kategori->deskripsi = $validateData['deskripsi'];
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
        $kategori->delete();
        return redirect()->route('kategori.index')->with('info-delete', "$kategori->kategori berhasil dihapus");
    }
}
