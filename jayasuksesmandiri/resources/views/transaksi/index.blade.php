@extends('layouts.main')
@section('title-page', 'Transaksi')
@section('title', ' Order Transaksi')
@section('content')
    <a href="{{ url('/') }}" class="btn btn-warning m-2"><i class="bi bi-arrow-90deg-left"></i><span class="badge badge-secondary">Home</span></a>
    <hr>
    <!-- Filter search transaksi berdasarkan tanggal -->
    <p class="mb-4">Date Runing</p>
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-bold">Filter Search Tanggal</h6>
        </div>
        <div class="card-body">
            <form action="/transaksi" method="{{ route('transaksi.index') }}">
                <label class="py-2" for="tanggal">Pilih Tanggal</label>
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
                    <a href="{{ route('transaksi.index') }}" class="btn btn-warning m-2">Reset</a>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-0">Daftar Barang</h5>

                    @if(session()->has('info-add'))
                        <div id="add-alert" class="alert alert-success alert-delete">
                            <button id="alert-add-btn" type="button" class="btn-close"></button>
                            {{ session()->get('info-add') }}
                        </div>
                        <script>
                            // Add Alert
                            addAlertClose = document.getElementById("alert-add-btn");
                            add_alert = document.getElementById("add-alert");
                            addAlertClose.addEventListener('click', function () {
                                add_alert.style.display="none"
                            });
                        </script>
                    @endif

                    <div class="py-2">
                        <button type="button" class="btn btn-primary btn-icon-split" onclick="location.href='{{ url('transaksi/create') }}'">
                            <span class="icon text-white"><i class="bi bi-plus-lg"></i></span>
                            <span class="text">Tambah Transaksi</span>
                        </button>
                    </div>
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Transaksi ID</th>
                            <th>Tanggal</th>
                            <th>Nama Pelanggan</th>
                            <th>Total Bayar</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transaksi as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>{{ $data->nama_pelanggan }}</td>
                                <td>{{ $data->total_harga }}</td>
                                <td><a href="{{ url('transaksi/'. $data->id) }}" class="btn btn-light m-2"><i class="bi bi-receipt"></i><span class="badge text-black">Detail Transaksi</span></a>
                                    <a href="{{ url('transaksi/'. $data->id. '/invoices') }}" class="btn btn-secondary m-2"><i class="bi bi-file-earmark-pdf"></i><span class="badge badge-secondary">Print Transaksi</span></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
