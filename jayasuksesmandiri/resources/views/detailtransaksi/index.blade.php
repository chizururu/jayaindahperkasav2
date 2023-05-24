@extends('layout')
@section('title-page', 'Transaksi')
@section('title', 'Detail Transaksi')
@section('content')
    <div class="pagetitle">
        <h1>Detail Transaksi</h1>
    </div>
    <hr>
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h5 class="card-title m-0">Informasi Pelanggan</h5>
        </div>
        <div class="card-body mt-2">
            <div class="py-4">
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Nomor Order</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="id" value ="{{ $transaksi->id }}" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Nama Pelanggan</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="nama_pelanggan" value ="{{ $transaksi->nama_pelanggan }}" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="no_telepon" value ="{{ $transaksi->no_telepon }}" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-7">
                        <textarea id="alamat" class="form-control" style="height: 80px" value ="{{ $transaksi->alamat }}" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Keranjang Barang</h5>
            <!-- Bordered Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jumlah Barang</th>
                        <th scope="col">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detailTransaksi as $detail)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $detail->inventaris->nama_barang }}</td>
                            <td>{{ $detail->jumlah_barang }}</td>
                            <td>{{ $detail->sub_total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End Bordered Table -->
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h5 class="card-title m-0">Pembayaran</h5>
        </div>
        <div class="card-body mt-2">
            <div class="py-4">
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Total Harga</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="{{ $transaksi->total_harga }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
