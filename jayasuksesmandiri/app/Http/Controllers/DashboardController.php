<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tanggal = date('Y-m-d');

        $jumlahBarang = DetailTransaksi::select()
            ->whereDate('detailtransaksis.created_at', $tanggal)
            ->sum('jumlah_barang');
        $totalHarga = DetailTransaksi::select()
            ->whereDate('detailtransaksis.created_at', $tanggal)
            ->sum('sub_total');

        $pelanggan = Transaksi::select()
            ->whereDate('created_at', $tanggal)
            ->count('id');

        /*Pendapatan berdasarkan line chart*/
        $result = DB::table('transaksis')
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') AS month"), DB::raw("SUM(total_harga) AS total"))
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();

        $labels = $result->pluck('month')->toArray();
        $data = $result->pluck('total')->toArray();
        return view('dashboard.index', compact('tanggal', 'totalHarga',
            'jumlahBarang', 'pelanggan', 'labels', 'data'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
