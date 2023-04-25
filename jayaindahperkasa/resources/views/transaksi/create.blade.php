@extends('layout')
@section('content')
    <div class="pagetitle">
        <h1>Form Transaksi</h1>
    </div>
    <hr>
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-weight-bold py-2">Informasi Pelanggan</h6>
        </div>
        <div class="card-body">
            <div class="py-4">
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <div class="row mb-2">
                        <label class="col-sm-4 col-form-label">Nama Pelanggan</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-4 col-form-label">Total Harga</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="total_harga" name="total_harga">
                        </div>
                    </div>
                    <div class="text-center p-3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-0">Daftar Barang</h5>
                    <div class="py-2">

                    </div>
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Satuan Harga</th>
                            <th>Total Harga</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
