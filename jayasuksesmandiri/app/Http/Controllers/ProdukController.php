<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\LaporMasukan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\LaporPengeluaran;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $produks = Produk::all();
        $kategoris = Kategori::all();

        return view('produk/index')->with('produks', $produks)
            ->with('kategoris', $kategoris);
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
        $validateData = $request->validate([
            'nama_barang' => 'required|unique:produks,nama_barang',
            'kategori_id' => 'required',
            'jumlah_stok' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'satuan' => 'required',
        ], [
            'nama_barang.required' => 'Nama barang harus diisi.',
            'nama_barang.unique' => 'Nama barang sudah ada.',
            'kategori_id.required' => 'Kategori harus diisi.',
            'jumlah_stok.required' => 'Jumlah stok harus diisi.',
            'harga_beli.required' => 'Harga beli harus diisi.',
            'harga_jual.required' => 'Harga jual harus diisi.',
            'satuan.required' => 'Satuan harus diisi.',
        ]);

        $produk = new Produk();
        $produk->nama_barang = $validateData['nama_barang'];
        $produk->kategori_id = $validateData['kategori_id'];
        $produk->jumlah_stok = $validateData['jumlah_stok'];
        $produk->harga_beli = $validateData['harga_beli'];
        $produk->harga_jual = $validateData['harga_jual'];
        $produk->satuan = $validateData['satuan'];

        $produk->save();

        $LaporanPemasukan = new LaporMasukan();
        $LaporanPemasukan->produk_id = $produk->id;
        $LaporanPemasukan->pemasukan = $produk->jumlah_stok;
        $LaporanPemasukan->save();

        return redirect()->route('produk.index')->with("info-add", "Barang $produk->nama_barang berhasil ditambah");
    }

    /**
     * Display the specified resource.
     */
    /*Produk $produk*/
    public function show($id, Request $request)
    {
        //
        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_terakhir = $request->input('tanggal_terakhir');

        $produk = Produk::find($id);

        if ($tanggal_mulai && $tanggal_terakhir) {
            $laporanPemasukan = LaporMasukan::where('produk_id', $id)
                ->where('pemasukan', '>', 0)
                ->whereBetween('created_at', [$tanggal_mulai, $tanggal_terakhir])
                ->get();

            $laporanPengeluaran = LaporPengeluaran::where('produk_id', $id)
                ->where('pengeluaran', '>', 0)
                ->whereBetween('created_at', [$tanggal_mulai, $tanggal_terakhir])
                ->get();
        } else {
            $laporanPemasukan = LaporMasukan::where('produk_id', $id)
                ->where('pemasukan', '>', 0)
                ->orderByDesc('created_at')
                ->get();

            $laporanPengeluaran = LaporPengeluaran::where('produk_id', $id)
                ->where('pengeluaran', '>', 0)
                ->orderByDesc('created_at')
                ->get();
        }
        $totalPemasukan = $laporanPemasukan->sum('pemasukan');
        $totalPengeluaran = $laporanPengeluaran->sum('pengeluaran');

        return view('produk.pemasukan')->with('produk', $produk)->with('laporanPemasukan', $laporanPemasukan)->with('tanggal_mulai', $tanggal_mulai)
            ->with('tanggal_terakhir', $tanggal_terakhir)
            ->with('totalPemasukan', $totalPemasukan)
            ->with('totalPengeluaran', $totalPengeluaran)
            ->with('laporanPengeluaran', $laporanPengeluaran);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validateData = $request->validate([ //validasi menyimpan data transaksi
            'nama_barang' => 'required|unique:produks,nama_barang,'.$id,
            'kategori_id' => 'required',
            'jumlah_stok' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'satuan' => 'required',
        ], [
            'nama_barang.required' => 'Nama barang harus diisi.',
            'nama_barang.unique' => 'Nama barang sudah ada.',
            'kategori_id.required' => 'Kategori harus diisi.',
            'jumlah_stok.required' => 'Jumlah stok harus diisi.',
            'harga_beli.required' => 'Harga beli harus diisi.',
            'harga_jual.required' => 'Harga jual harus diisi.',
            'satuan.required' => 'Satuan harus diisi.',
        ]);
        $produk = Produk::find($id);
        $produk->nama_barang = $validateData['nama_barang'];
        $produk->kategori_id = $validateData['kategori_id'];

        $jumlahStokSebelum = $produk->jumlah_stok;
        $jumlahStokSesudah = $validateData['jumlah_stok'];

        if ($jumlahStokSesudah != $jumlahStokSebelum) {
            if($jumlahStokSesudah < $jumlahStokSebelum) {
                $pengeluaran = new LaporPengeluaran();
                $pengeluaran->produk_id = $produk->id;
                $pengeluaran->pengeluaran = $jumlahStokSebelum - $jumlahStokSesudah;
                $pengeluaran->save();
            } else {
                $LaporanPemasukan = new LaporMasukan();
                $LaporanPemasukan->produk_id = $produk->id;
                $LaporanPemasukan->pemasukan = $jumlahStokSesudah - $jumlahStokSebelum;
                $LaporanPemasukan->save();
            }
        }
        $produk->jumlah_stok = $jumlahStokSesudah;
        $produk->harga_beli = $validateData['harga_beli'];
        $produk->harga_jual = $validateData['harga_jual'];

        $produk->satuan = $validateData['satuan'];

        $produk->save();
        return redirect()->route('produk.index')->with("info-update", "Barang $produk->nama_barang berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $produk = Produk::find($id);
        $produk->delete();
        return redirect()->route('kategori.index')->with('info-delete', "$produk->nama_barang berhasil dihapus");
    }
}
