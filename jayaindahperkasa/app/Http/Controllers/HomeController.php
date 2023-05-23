<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

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
        //
        $user = Auth::user();

        if ($user && $user->status == 0) {
            Auth::logout();
            return view('waiting');
        }
        return view('home');
        
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
        return view('home', compact('tanggal', 'totalHarga',
            'jumlahBarang', 'pelanggan', 'labels', 'data'));
    }
}
