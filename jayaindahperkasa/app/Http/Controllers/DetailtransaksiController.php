<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailtransaksiController extends Controller
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
        $jumlahBarang = DetailTransaksi::select()
            ->whereDate('detailtransaksis.created_at', $tanggal)
            ->sum('jumlah_barang');
        $totalHarga = DetailTransaksi::select()
            ->whereDate('detailtransaksis.created_at', $tanggal)
            ->sum('sub_total');
        $detailtransaksi = DetailTransaksi::select('inventaris_id', DB::raw('SUM(jumlah_barang) AS jumlah' ),
            DB::raw('SUM(sub_total) AS total'))
            ->join('inventaris', 'detailtransaksis.inventaris_id','=','inventaris.id')
            ->whereDate('detailtransaksis.created_at', $tanggal)
            ->groupBy('inventaris_id', 'inventaris.nama_barang')
            ->orderBy('inventaris.nama_barang')
            ->get();

        return view('laporan.index', compact('detailtransaksi', 'tanggal', 'totalHarga', 'jumlahBarang'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(detailTransaksi $detailtransaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detailTransaksi $detailtransaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detailTransaksi $detailtransaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detailTransaksi $detailtransaksi)
    {
        //
    }
}
