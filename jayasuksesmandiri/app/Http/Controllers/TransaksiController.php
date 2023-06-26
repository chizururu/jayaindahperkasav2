<?php

namespace App\Http\Controllers;

use App\Models\LaporPengeluaran;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use PDF;

class TransaksiController extends Controller
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
            $tanggal_mulai = date('Y-m-d 00:00:00', strtotime($tanggal_mulai));
            $tanggal_terakhir = date('Y-m-d 23:59:59', strtotime($tanggal_terakhir));
        } elseif ($tanggal_mulai) {
            $tanggal_mulai = date('Y-m-d 00:00:00', strtotime($tanggal_mulai));
            $tanggal_terakhir = date('Y-m-d 23:59:59', strtotime($tanggal_mulai));
        } else {
            $tanggal_mulai = null;
            $tanggal_terakhir = null;
        }

        if ($tanggal_mulai && $tanggal_terakhir) {
            $transaksi = Transaksi::whereBetween('created_at', [$tanggal_mulai, $tanggal_terakhir])->get();
        } else {
            $transaksi = Transaksi::all();
        }

        return view('transaksi.index', compact('transaksi', 'tanggal_mulai', 'tanggal_terakhir'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $produk = Produk::all();
        return view('transaksi.create')->with('produk', $produk);
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
            'no_telepon' => 'required',
            'alamat' => 'required',

        ]);
        $transaksi = new Transaksi();
        $transaksi->nama_pelanggan = $validateData['nama_pelanggan'];
        $transaksi->total_harga = $validateData['total_harga'];
        $transaksi->no_telepon = $validateData['no_telepon'];
        $transaksi->alamat = $validateData['alamat'];
        $transaksi->save();

        $transaksi_id = $transaksi->id;
        $daftar_barang = json_decode($request->input('daftar_barang'),true);
        foreach ($daftar_barang as $barang) {
            $produk = Produk::find($barang['id']);

            $detailtransaksi = new DetailTransaksi();
            $detailtransaksi->transaksi_id = $transaksi_id;
            $detailtransaksi->nama_barang = $produk->nama_barang;
            $detailtransaksi->harga_barang = $produk->harga_jual;
            $detailtransaksi->jumlah_barang = $barang['jumlah'];
            $detailtransaksi->sub_total = $barang['subharga'];
            $detailtransaksi->save();

            // Mengurangi Stok Barang
            $produk -> jumlah_stok -= $barang['jumlah'];
            $produk-> save();

            // Laporan Pengeluaran
            $LaporanPengeluaran = new LaporPengeluaran();
            $LaporanPengeluaran->pengeluaran = $barang['jumlah'];;
            $LaporanPengeluaran->produk_id = $barang['id'];
            $LaporanPengeluaran->status = 'Pembelian Barang';
            $LaporanPengeluaran->save();
        };
        return redirect()->route('transaksi.index')->with("info-add", "Order $transaksi->id, $transaksi->nama_pelanggan berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
        $detailTransaksi = DetailTransaksi::where('transaksi_id', $transaksi->id)->get();
        return view('transaksi.show', compact('transaksi', 'detailTransaksi'));

    }
    /*
     * Cetak Nota melalui pdf
     * */

    public function invoices(Transaksi $transaksi) {
        $detailTransaksi = DetailTransaksi::where('transaksi_id', $transaksi->id)->get();

        $pdf = PDF::loadView('transaksi.invoice', compact('transaksi', 'detailTransaksi'));
        $filename = $transaksi->nama_pelanggan . '-' . $transaksi->id . '-' .date('Ymd'). ' Invoices' . '.pdf' ;
        return $pdf->download($filename);

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
