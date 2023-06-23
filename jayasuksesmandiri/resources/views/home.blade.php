@extends('layouts.main')
@section('title-page', 'Dashboard')
@section('title', ' Dashboard')

@section('content')
    <div class="login-alert">
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <span class="fw-medium">Selamat Datang <span class="fw-bold">{{ Auth::user()->name }}</span></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="row">

                <!-- Sales Card -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tanggal dan Waktu <span>| Today</span></h5>
                        <div id="date" class="fw-bold"></div>
                        <div id="time"></div>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Barang Terjual <span>| Today</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $barangTerjualToday }}</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Pendapatan <span>| This Month</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>Rp.{{ $pendapatanThisMonth }}</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Revenue Card -->

                <!-- Customers Card -->
                <div class="col-xxl-4 col-xl-12">

                    <div class="card info-card customers-card">

                        <div class="card-body">
                            <h5 class="card-title">Pembeli <span>| This Year</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $pelangganThisYear }}</h6>
                                </div>
                            </div>

                        </div>
                    </div>

                </div><!-- End Customers Card -->

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Status Produk <span>| Today</span></h5>

                            <table class="table table-borderless datatable">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Harga Jual</th>
                                    <th scope="col">Jumlah Stok</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($produk as $items)
                                    <tr>
                                        <th scope="row">#{{ $loop->iteration }}</th>
                                        <td><a href="{{ url('produk/'. $items->id) }}">{{ $items->nama_barang }}</a></td>
                                        <td>{{ $items->harga_jual }}</td>
                                        <td>{{ $items->jumlah_stok }}</td>
                                        <td>
                                            @if($items->jumlah_stok > 0)
                                                <span class="badge bg-success">Masih Ada</span>
                                            @else
                                                <span class="badge bg-danger">Stok Habis</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div><!-- End Recent Sales -->

            </div>
        </div>
    </section>
    <script>
        function showDateTime() {
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            var hour = date.getHours();
            var minute = date.getMinutes();
            var second = date.getSeconds();

            day = (day < 10) ? "0" + day : day;
            month = (month < 10) ? "0" + month : month;
            hour = (hour < 10) ? "0" + hour : hour;
            minute = (minute < 10) ? "0" + minute : minute;
            second = (second < 10) ? "0" + second : second;

            var date = day + "/" + month + "/" + year
            var time = hour + ":" + minute + ":" + second;
            document.getElementById('date').innerHTML = date;
            document.getElementById('time').innerHTML = time;

            setTimeout(showDateTime, 1000);
        }

        showDateTime()
    </script>
@endsection
