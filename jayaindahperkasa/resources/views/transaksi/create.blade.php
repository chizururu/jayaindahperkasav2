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
                    <h5 class="card-title m-0">Tambah Barang</h5>
                    <form class="row g-3">
                        <div class="col-md-4">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <select id="nama_barang" class="form-select">
                                <option selected>Pilih Barang</option>
                                @foreach($inventaris as $data)
                                    <option value="{{ $data->id }}" nama-barang="{{ $data->nama_barang }}"
                                    harga-barang="{{ $data->harga_jual }}">{{ $data->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="harga_barang" class="form-label">Harga Barang</label>
                            <input type="text" class="form-control" id="harga_barang" name="harga_barang" placeholder="0">
                        </div>
                        <div class="col-md-2">
                            <label for="harga_barang" class="form-label">Jumlah Barang</label>
                            <input type="text" class="form-control"  id="jumlah_barang" name="jumlah_barang" placeholder="0">
                        </div>
                        <div class="col-md-4">
                            <label for="total_harga" class="form-label">Total Harga</label>
                            <input type="text" class="form-control" id="total_harga" name="total_harga" placeholder="0">
                        </div>
                        <div class="text-center p-3">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-0">Daftar Barang</h5>
                    <table id="tabel-barang" class="table datatable">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

    </script>
@endsection










{{--let produk = []--}}
{{--const selectedBarang = document.querySelector('#nama_barang');--}}
{{--selectedBarang.addEventListener('change', function () {--}}
{{--const selectionOption = this.options[this.selectedIndex];--}}
{{--const hargaBarang = selectionOption.getAttribute('harga-barang');--}}
{{--const jumlah = document.getElementById('jumlah_barang').value;--}}
{{--console.log(jumlah);--}}
{{--document.getElementById('harga_barang').value = hargaBarang;--}}
{{--document.getElementById('total_harga').value = hargaBarang*2;--}}
{{--});--}}
