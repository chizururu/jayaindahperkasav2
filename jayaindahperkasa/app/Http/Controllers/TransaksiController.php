<?php

namespace App\Http\Controllers;

use App\Models\inventaris;
use App\Models\transaksi;
use Illuminate\Http\Request;

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
        $transaksi = transaksi::whereDate('created_at', $tanggal)->get();
        return view('transaksi.index', compact('transaksi', 'tanggal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $inventaris = inventaris::all();
        return view('transaksi.create')->with('inventaris', $inventaris);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'nama_pelanggan' => 'required',
            'total_harga' => 'required',
        ]);
        $transaksi = new transaksi();
        $transaksi->nama_pelanggan = $validateData['nama_pelanggan'];
        $transaksi->total_harga = $validateData['total_harga'];
        $transaksi->save();

        return redirect()->route('transaksi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaksi $transaksi)
    {
        //
    }
}
