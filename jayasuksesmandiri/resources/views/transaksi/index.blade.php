@extends('layout')
@section('title-page', 'Transaksi')
@section('title', ' Order Transaksi')
@section('content')
    <div class="pagetitle">
        <h1>Order Transaksi</h1>
    </div>
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
                        <input class="form-control" type="date" name="tanggal" value="{{ request()->input('tanggal') ?? date('Y-m-d') }}">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Search</button>
                        @if($tanggal)
                            <a href="{{ route('transaksi.index') }}" class="btn btn-warning">Reset</a>
                        @endif
                    </div>
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
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->nama_pelanggan }}</td>
                                    <td>{{ $data->total_harga }}</td>
                                    <td><a href="{{ url('transaksi/'. $data->id) }}">Show</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
