@extends('layout')
@section('content')
    <div class="pagetitle">
        <h1>Form Transaksi</h1>
    </div>
    <hr>
    <form action="{{ route('transaksi.store') }}" method="POST" id="form-transaksi">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <h5 class="card-title m-0">Informasi Pelanggan</h5>
            </div>
            <div class="card-body mt-2">
                <div class="py-4">
                    <input type="hidden" name="daftar_barang" id="daftar_barang">
                    <div class="row mb-2">
                        <label class="col-sm-4 col-form-label">Nama Pelanggan</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <h5 class="card-title m-0">Daftar Barang</h5>
            </div>
            <div class="card-body mt-2">
                <table id="tabel-barang" class="table">
                    <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Satuan Harga</th>
                        <th>Jumlah Barang</th>
                        <th>Sub Harga</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                    </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary" onclick="addRow()">Add Row</button>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <h5 class="card-title m-0">Informasi Pelanggan</h5>
            </div>
            <div class="card-body mt-2">
                <div class="py-4">
                    <div class="row mb-2">
                        <label class="col-sm-4 col-form-label">Total Harga</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="total_harga" name="total_harga">
                        </div>
                    </div>
                    <div class="text-center p-3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        function addRow() {
            const tabel = document.getElementById('tabel-barang');
            const row = tabel.insertRow();

            const tnamaBarang = row.insertCell(0);
            const thargaSatuan = row.insertCell(1);
            const tjumlahBarang = row.insertCell(2);
            const tsubHarga = row.insertCell(3);
            const taction = row.insertCell(4);

            tnamaBarang.innerHTML = '<select id="nama_barang" class="form-select" for="nama_barang[]">'+
                '<option value="">Pilih Barang</option>'+
                '@foreach($inventaris as $inv)'+
                '<option value="{{ $inv->id }}" nama-barang="{{ $inv->nama_barang }}" harga-jual="{{ $inv->harga_jual }}">{{ $inv->nama_barang }}</option>'+
                '@endforeach'+
                '</select>';
            thargaSatuan.innerHTML = '<input type="number" class="form-control" id="harga_barang" name="harga_barang[]">';
            tjumlahBarang.innerHTML = '<input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang[]" onkeyup="addField()">';
            tsubHarga.innerHTML = '<input type="number" class="form-control" id="sub_harga" name="sub_harga[]" onkeyup="addField()" readonly>';
            taction.innerHTML = '<button type="button" class="btn btn-danger" onclick="deleteRow()">Delete</button>';

        }
    </script>
@endsection
