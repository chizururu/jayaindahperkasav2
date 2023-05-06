@extends('layout')
@section('content')
    <div class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-3 col-md-3">
                        <div class="card info-card">
                            <div class="card-body">
                                <h5 class="card-title">Date & Time <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary-light">
                                        <i class="bi bi-clock"></i>
                                    </div>
                                    <div class="ps-3">
                                        <div>
                                            <div id="date" class="fw-bold"></div>
                                            <div id="time"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Sales Card -->
                    <div class="col-xxl-3 col-md-3">
                        <div class="card info-card">
                            <div class="card-body">
                                <h5 class="card-title">Produk Dijual <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-secondary-light">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <div class="fw-bold">{{ $jumlahBarang }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-3 col-md-3">
                        <div class="card info-card">
                            <div class="card-body">
                                <h5 class="card-title">Pendapatan <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <div class="fw-bold">Rp {{ $totalHarga }}</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-3 col-md-3">

                        <div class="card info-card">
                            <div class="card-body">
                                <h5 class="card-title">Pelanggan <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-danger-light">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <div class="fw-bold">{{ $pelanggan }}</div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Grafik Pendapatan</h5>

                <!-- Line Chart -->
                <canvas id="lineChart" style="max-height: 600px;"></canvas>
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        new Chart(document.querySelector('#lineChart'), {
                            type: 'line',
                            data: {
                                labels: {!! json_encode($labels) !!},
                                datasets: [{
                                    label: 'Pendapatan',
                                    data: {!! json_encode($data) !!},
                                    fill: false,
                                    borderColor: 'rgb(208,91,91)',
                                    tension: 0.1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    });
                </script>
                <!-- End Line CHart -->

            </div>
        </div>
    </div>

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
