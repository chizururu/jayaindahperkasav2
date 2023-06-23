<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_terakhir = $request->input('tanggal_terakhir');

        if ($tanggal_mulai && $tanggal_terakhir) {
            $jumlahBarang = DetailTransaksi::select()
                ->whereBetween('created_at', [$tanggal_mulai, $tanggal_terakhir])
                ->sum('jumlah_barang');
            $totalHarga = DetailTransaksi::select()
                ->whereBetween('created_at', [$tanggal_mulai, $tanggal_terakhir])
                ->sum('sub_total');

            $detailtransaksi = DetailTransaksi::select('nama_barang', DB::raw('SUM(jumlah_barang) AS jumlah' ),
                DB::raw('SUM(sub_total) AS total'))
                ->whereBetween('created_at', [$tanggal_mulai, $tanggal_terakhir])
                ->groupBy('nama_barang')
                ->get();

        } else {
            $jumlahBarang = DetailTransaksi::select()
                ->sum('jumlah_barang');
            $totalHarga = DetailTransaksi::select()
                ->sum('sub_total');

            $detailtransaksi = DetailTransaksi::select('nama_barang', DB::raw('SUM(jumlah_barang) AS jumlah' ),
                DB::raw('SUM(sub_total) AS total'))
                ->groupBy('nama_barang')
                ->get();
        }


        return view('transaksi.laporan', compact('detailtransaksi', 'tanggal_mulai', 'tanggal_terakhir', 'totalHarga', 'jumlahBarang'));
        //fungsi menampilkan halaman laporan/index.blade.php

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
    public function show(DetailTransaksi $detailTransaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailTransaksi $detailTransaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailTransaksi $detailTransaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailTransaksi $detailTransaksi)
    {
        //
    }
}
