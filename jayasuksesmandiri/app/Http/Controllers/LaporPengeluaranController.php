<?php

namespace App\Http\Controllers;

use App\Models\LaporPengeluaran;
use Illuminate\Http\Request;
use App\Models\Produk;


class LaporPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'pengeluaran' => 'required',
        ], [
            'pengeluaran.required' => 'Field Input Pengeluaran Tidak Boleh Kosong.'
        ]);

        /* Mengubah NIlai Negatif menjadi 0 */


        $LaporanPengeluaran = new LaporPengeluaran();
        $LaporanPengeluaran->pengeluaran = max(0, $validateData['pengeluaran']);
        $LaporanPengeluaran->produk_id = $validateData['produk_id'];
        $LaporanPengeluaran->status = 'Pengurangan Stok Barang';
        $LaporanPengeluaran->save();
        /*Menambahkan stok barang setelah menambah jumlah stok barang*/

        $produk = Produk::find($validateData['produk_id']);
        $jumlahProduk = $produk->jumlah_stok;

        // Menambahkan stok barang hanya jika pemasukan lebih dari 0
        if (is_nan($LaporanPengeluaran->pengeluaran)||$LaporanPengeluaran->pengeluaran <= 0) {
            return redirect()->back()->with("error", "Jumlah Pengeluaran Barang Tidak Boleh Pakai - dan Kurang Sama Dengan 0");
        } elseif ($LaporanPengeluaran->pengeluaran > $jumlahProduk){
            return redirect()->back()->with("error", "Jumlah Pengeluaran Barang Tidak Boleh Melebihi Stok Barang");
        } else {
            $produk->jumlah_stok -= $LaporanPengeluaran->pengeluaran;
            $produk->save();
            return redirect()->back()->with("info-update", "Jumlah Stok Barang $produk->nama_barang berhasil Dikurangi");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporPengeluaran $laporPengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporPengeluaran $laporPengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporPengeluaran $laporPengeluaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporPengeluaran $laporPengeluaran)
    {
        //
    }
}
