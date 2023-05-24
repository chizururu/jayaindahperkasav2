@extends('layout')
@section('title-page', 'Transaksi')
@section('title', 'Laporan Transaksi')
@section('content')
    <div class="pagetitle">
        <h1>Laporan Transaksi</h1>
    </div>
    {{-- Filter Search Transaksi Berdasarkan Tanggal --}}
    <p class="mb-4">Date Runing</p>
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-bold">Filter Search Tanggal</h6>
        </div>
        <div class="card-body">
            <form action="/laporan" method="{{ route('laporan.index') }}">
                <label class="py-2">Pilih Tanggal</label>
                <div class="row">
                    <div class="col">
                        <input class="form-control" type="date" name="tanggal" value="{{ request()->input('tanggal') ?? date('Y-m-d')}}">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn  btn-primary">Search</button>
                        @if($tanggal)
                            <a href="{{ route('laporan.index') }}" class="btn  btn-warning">Reset</a>
                        @endif
                    </div>
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
                                <td>{{ $data->inventaris->nama_barang}}</td>
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
