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
                    <input type="hidden" name="daftar_barang" value="JSON.stringify(daftarBarang)">
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
                            <input type="text" class="form-control" id="harga_barang" name="harga_barang" onkeyup="addForm()" placeholder="0">
                        </div>
                        <div class="col-md-2">
                            <label for="harga_barang" class="form-label">Jumlah Barang</label>
                            <input type="text" class="form-control"  id="jumlah_barang" name="jumlah_barang" value="1" onkeyup="addForm()" required>
                        </div>
                        <div class="col-md-4">
                            <label for="sub_harga" class="form-label">Total Harga</label>
                            <input type="text" class="form-control" id="sub_harga" name="sub_harga" placeholder="0">
                        </div>
                        <div class="text-center p-3">
                            <button type="button" class="btn btn-primary" onclick="tambahBarang()">Add</button>
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
                        <body>
                        </body>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        let daftarBarang = [];
        const selectedBarang = document.querySelector('#nama_barang');
        var idBarang, namaBarang, hargaBarang, jumlah_barang, subHarga;
        selectedBarang.addEventListener('change', function () {
            const selectionOption = this.options[this.selectedIndex]
            hargaBarang = selectionOption.getAttribute('harga-barang');
            namaBarang = selectionOption.getAttribute('nama-barang');
            document.getElementById('harga_barang').value = hargaBarang;
            addForm();
        });
        function addForm(){
            hargaBarang = document.getElementById('harga_barang').value;
            jumlahBarang = document.getElementById('jumlah_barang').value;
            document.getElementById('sub_harga').value = jumlahBarang*hargaBarang;
        }
        function tambahBarang() {
            idBarang = selectedBarang.options[selectedBarang.selectedIndex].getAttribute('value');
            namaBarang = selectedBarang.options[selectedBarang.selectedIndex].getAttribute('nama-barang');
            hargaBarang = document.getElementById('harga_barang').value;
            jumlahBarang = document.getElementById('jumlah_barang').value;
            subHarga = document.getElementById('sub_harga').value;

            const barang = {id : daftarBarang.length + 1, idbrg : idBarang, nama : namaBarang, harga : hargaBarang, jumlah : jumlahBarang, sub : subHarga}
            daftarBarang.push(barang);

            datatabel();
            hitungTotalBayar();

            selectedBarang.selectedIndex = 0;
            document.getElementById('harga_barang').value = 0;
            document.getElementById('jumlah_barang').value = 1;
            document.getElementById('sub_harga').value = 0;
            console.log(daftarBarang);
        }

        function datatabel() {
            const table = document.getElementById("tabel-barang");
            const row = table.insertRow();

            const tnamaBarang = row.insertCell(0);
            const thargaSatuan = row.insertCell(1);
            const tjumlahBarang = row.insertCell(2);
            const tsubHarga = row.insertCell(3);
            const taction = row.insertCell(4);

            for (var i = 0; i < daftarBarang.length; i++) {
                tnamaBarang.innerHTML = daftarBarang[i].nama;
                thargaSatuan.innerHTML = daftarBarang[i].harga;
                tjumlahBarang.innerHTML = daftarBarang[i].jumlah;
                tsubHarga.innerHTML = daftarBarang[i].sub;
                taction.innerHTML = '<button type="button" class="btn btn-danger" onclick="deleteBarang(this)"><i class="bi bi-trash"></i></button>'
            }
        }
        function deleteBarang(button){
            const row = button.closest('tr');
            const index = row.rowIndex -1 ;
            daftarBarang.splice(index, 1);
            row.remove();
            console.log(daftarBarang);
        }

        function hitungTotalBayar() {
            var totalHarga = 0;

            for (var i = 0; i < daftarBarang.length; i++) {
                totalHarga += daftarBarang[i].jumlah * daftarBarang[i].harga;
                console.log(daftarBarang);
            }
            console.log(totalHarga);

            document.getElementById('total_harga').value = totalHarga;
        }
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
