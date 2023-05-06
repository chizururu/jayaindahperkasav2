<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Inventaris;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $tanggal = $request->input('tanggal');

        if(!$tanggal) {
            $tanggal = date('Y-m-d');
        }
        $transaksi = Transaksi::whereDate('created_at', $tanggal)->get();
        return view('transaksi.index', compact('transaksi', 'tanggal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $inventaris = Inventaris::all();
        return view('transaksi.create')->with('inventaris', $inventaris);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_pelanggan' => 'required',
            'total_harga' => 'required',
        ]);
        $transaksi = new Transaksi();
        $transaksi->nama_pelanggan = $validateData['nama_pelanggan'];
        $transaksi->total_harga = $validateData['total_harga'];
        $transaksi->save();

        $transaksi_id = $transaksi->id;
        $daftar_barang = json_decode($request->input('daftar_barang'),true);
        foreach ($daftar_barang as $barang) {
            $detailtransaksi = new DetailTransaksi();
            $detailtransaksi->transaksi_id = $transaksi_id;
            $detailtransaksi->inventaris_id = $barang['id'];
            $detailtransaksi->jumlah_barang = $barang['jumlah'];
            $detailtransaksi->sub_total = $barang['subharga'];
            $detailtransaksi->save();
        };
        return redirect()->route('transaksi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
