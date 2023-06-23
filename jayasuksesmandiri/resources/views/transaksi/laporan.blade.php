@extends('layouts.main')
@section('title-page', 'Laporan Transaksi Penjualan Barang')
@section('title', 'Laporan Transaksi')
@section('content')
    <a href="{{ url('/transaksi') }}" class="btn btn-warning m-2"><i class="bi bi-arrow-90deg-left"></i><span class="badge badge-secondary">Kembali</span></a>
    <hr>
    </div>
    {{-- Filter Search Transaksi Berdasarkan Tanggal --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="card-title">Filter Search</h5>
            <form action="/laporantransaksi" method="{{ route('transaksi.index') }}">
                <div class="row">
                    <div class="col">
                        <label class="py-2" for="tanggal_mulai">Tanggal Mulai</label>
                        <input class="form-control" type="date" name="tanggal_mulai" value="{{ request()->input('tanggal_mulai') }}">
                    </div>
                    <div class="col">
                        <label class="py-2" for="tanggal_terakhir">Tanggal Terakhir</label>
                        <input class="form-control" type="date" name="tanggal_terakhir" value="{{ request()->input('tanggal_terakhir') }}">
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary m-2">Search</button>
                    <a href="/laporantransaksi" class="btn btn-warning m-2">Reset</a>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Barang</h5>
                    <p class="card-text fw-bold">{{ $jumlahBarang }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Pemasukan</h5>
                    <p class="card-text fw-bold">{{ $totalHarga }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-0">Daftar Barang</h5>
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Total Pemasukan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($detailtransaksi as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama_barang }}</td>
                                <td>{{ $data->jumlah }}</td>
                                <td>{{ $data->total }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
