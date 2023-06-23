@extends('layouts.main')
@section('title-page', 'Detail Produk '. $produk->nama_barang)
@section('title', 'Detail '.  $produk->nama_barang)
@section('content')
    <a href="{{ url('/produk') }}" class="btn btn-warning m-2"><i class="bi bi-arrow-90deg-left"></i><span class="badge badge-secondary">Kembali</span></a>
    <hr>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Detail Produk</h5>
            <!-- Multi Columns Form -->
            @if(session()->has('info-update'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ session()->get('info-update') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ session()->get('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    @foreach ($errors->all() as $error)
                       {{ $error }}
                    @endforeach
                </div>
            @endif
            <div class="row g-3">
                <div class="col-md-12">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" value="{{ $produk->nama_barang }}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="kategori" value="{{ $produk->kategori->kategori }}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                    <input type="text" class="form-control" id="jumlah_stok" value="{{ $produk->jumlah_stok }}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="harga_beli" class="form-label">Harga Beli</label>
                    <input type="text" class="form-control" id="harga_beli" value="{{ $produk->harga_beli }}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="harga_jual" class="form-label">Harga Jual</label>
                    <input type="text" class="form-control" id="harga_jual" value="{{ $produk->harga_jual }}" disabled>
                </div>
                <div class="mt-5">
                    <div class="text-center">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStok">Atur Stok Barang</button>
                    </div>
                </div>
            </div><!-- End Multi Columns Form -->

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Filter Laporan</h5>
            <form action="{{ route('produk.show', $produk->id) }}" method="GET">
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
                    <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-warning m-2">Reset</a>
                </div>
            </form>
        </div>
    </div>
    <div class="">
        <section class="section dashboard">
            <div class="row justify-content-center">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-6 col-md-5">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Pemasukan</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-box-arrow-down text-success"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $totalPemasukan }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Pengeluaran</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-box-arrow-up text-danger"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $totalPengeluaran }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->
                </div>
            </div>
        </section>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pemasukan</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Pemasukan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($laporanPemasukan as $laporan)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $laporan->created_at }}</td>
                                <td>{{ $laporan->pemasukan }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pengeluaran</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Pengeluaran</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($laporanPengeluaran as $laporan)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $laporan->created_at }}</td>
                                <td>{{ $laporan->pengeluaran }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>
        </div>
    </div>
    <!-- Add Stok -->
    <div class="modal fade" id="addStok" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atur Stok Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Tambah Stok</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Kurang Stok</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form class="row g-3" id="addForm" action="{{ route('pemasukan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                <div class="col-md-12">
                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang" value="{{ $produk->nama_barang }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <input type="text" class="form-control" id="kategori" value="{{ $produk->kategori->kategori }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label for="stok" class="form-label">Stok Saat Ini</label>
                                    <input type="text" class="form-control" id="stok" name="stok" value="{{ $produk->jumlah_stok }}" readonly>
                                </div>
                                <div class="col-md-12">
                                    <label for="pemasukan" class="form-label">Pemasukan Stok</label>
                                    <input type="text" class="form-control" id="pemasukan" name="pemasukan">
                                </div>
                                <div class="modal-footer text-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <form class="row g-3" id="addForm" action="{{ route('pengeluaran.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                <div class="col-md-12">
                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang" value="{{ $produk->nama_barang }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <input type="text" class="form-control" id="kategori" value="{{ $produk->kategori->kategori }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label for="stok" class="form-label">Stok Saat Ini</label>
                                    <input type="text" class="form-control" id="stok" name="stok" value="{{ $produk->jumlah_stok }}" readonly>
                                </div>
                                <div class="col-md-12">
                                    <label for="pengeluaran" class="form-label">Pengeluaran</label>
                                    <input type="text" class="form-control" id="Pengeluaran" name="pengeluaran">
                                </div>
                                <div class="modal-footer text-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- End Default Tabs -->

                </div>
            </div>
        </div>
    </div><!-- End Disabled Backdrop Modal-->
@endsection
