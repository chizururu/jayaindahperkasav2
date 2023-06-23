<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Produk;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {

        $barangTerjualToday = DetailTransaksi::whereDate('created_at', now()->format('Y-m-d'))
            ->sum('jumlah_barang');

        $pendapatanThisMonth = Transaksi::whereMonth('created_at', now()->format('m'))
            ->sum('total_harga');

        $pelangganThisYear = Transaksi::whereYear('created_at', now()->format('Y'))
            ->count();

        $produk = Produk::all();
        return view('home', compact('barangTerjualToday', 'pendapatanThisMonth', 'pelangganThisYear'
            ,'produk'));
    }
}
