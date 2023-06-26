<?php

namespace App\Http\Controllers;

use App\Models\LaporMasukan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LapormasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('produk/pemasukan');
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
            'produk_id' => 'required',
            'pemasukan' => 'required',
        ],[
            'pemasukan.required' => 'Field Input Penambahan Tidak Boleh Kosong.',
        ]);

        /* Mengubah NIlai Negatif menjadi 0 */


        $LaporanPemasukan = new LaporMasukan();
        $LaporanPemasukan->pemasukan = max(0, $validateData['pemasukan']);
        $LaporanPemasukan->produk_id = $validateData['produk_id'];
        $LaporanPemasukan->status = 'Penambahan Stok Barang';
        $LaporanPemasukan->save();
        /*Menambahkan stok barang setelah menambah jumlah stok barang*/

        $produk = Produk::find($validateData['produk_id']);
        // Menambahkan stok barang hanya jika pemasukan lebih dari 0

        if (is_nan($LaporanPemasukan->pemasukan)||$LaporanPemasukan->pemasukan <= 0) {
            return redirect()->back()->with("error", "Jumlah Pemasukan Barang Tidak Boleh Pakai - dan Kurang Sama Dengan 0");
        }  else {
            $produk->jumlah_stok += $LaporanPemasukan->pemasukan;
            $produk->save();
            return redirect()->back()->with("info-update", "Jumlah Stok Barang $produk->nama_barang berhasil Ditambah");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(laporMasukan $lapormasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(laporMasukan $lapormasukan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, laporMasukan $lapormasukan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(laporMasukan $lapormasukan)
    {
        //
    }
}
