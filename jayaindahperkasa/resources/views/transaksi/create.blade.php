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
                        <td>
                            <select id="nama_barang" class="form-select" for="nama_barang[]">
                                <option value="">Pilih Barang</option>
                                @foreach($inventaris as $inv)
                                    <option value="{{ $inv->id }}" nama-barang="{{ $inv->nama_barang }}" harga-jual="{{ $inv->harga_jual }}">{{ $inv->nama_barang }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" class="form-control" id="harga_barang" name="harga_barang[]">
                        </td>
                        <td>
                            <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang[]" onkeyup="addField()">
                        </td>
                        <td>
                            <input type="number" class="form-control" id="sub_harga" name="sub_harga[]" onkeyup="addField()" readonly>
                        </td>
                        <td>
                            <button id="btn-add" type="button" class="btn btn-success btn-tambah m-1" onclick="tambahBarang()">Add</button>
                            <button id="btn-update" type="button" class="btn btn-primary btn-update m-1" onclick="update()">Update</button>
                            <button id="btn-cancel" type="button" class="btn btn-primary btn-danger m-1" onclick="cancel()">Cancel</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
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

        var editbtn = document.getElementById('btn-update');
        var addBtn = document.getElementById('btn-add');
        var cancelBtn = document.getElementById('btn-cancel');

        editbtn.style.display = "none";
        cancelBtn.style.display = "none";

        let daftarBarang = [];
        var barangId, namaBarang, hargaBarang, jumlahBarang, subHarga;
        const selection = document.querySelector('#nama_barang');
        selection.addEventListener('change', function () {
            const selectionOption = this.options[this.selectedIndex]
            hargaBarang = selectionOption.getAttribute('harga-jual');
            /*console.log(hargaBarang);*/
            document.getElementById('harga_barang').value = hargaBarang;
            /*console.log(selectionOption);*/
        });

        function addField() {
            hargaBarang = document.getElementById('harga_barang').value;
            jumlahBarang = document.getElementById('jumlah_barang').value;
            document.getElementById('sub_harga').value = hargaBarang*jumlahBarang;
        }

        function tambahBarang() {
            idBarang = selection.options[selection.selectedIndex].getAttribute('value');
            namaBarang = selection.options[selection.selectedIndex].getAttribute('nama-barang');
            hargaBarang = document.getElementById('harga_barang').value;
            jumlahBarang = document.getElementById('jumlah_barang').value;
            subHarga = document.getElementById('sub_harga').value;

            const barang = {
                id : daftarBarang.length,
                idBrg : idBarang,
                nama : namaBarang,
                harga : hargaBarang,
                jumlah : jumlahBarang,
                sub : subHarga}

            daftarBarang.push(barang);
            datatabel();
            totalBayar();
            dummy();
            /*console.log(daftarBarang);*/
            selection.selectedIndex = 0
            document.getElementById('harga_barang').value = '';
            document.getElementById('jumlah_barang').value = '';
            document.getElementById('sub_harga').value = '';
        }

        function datatabel() {
            const tabel = document.getElementById('tabel-barang');
            const row = tabel.insertRow()

            const tnamaBarang = row.insertCell(0);
            const thargaSatuan = row.insertCell(1);
            const tjumlahBarang = row.insertCell(2);
            const tsubHarga = row.insertCell(3);
            const tAction = row.insertCell(4);

            for (var i = 0; i < daftarBarang.length; i++) {
                tnamaBarang.innerHTML = daftarBarang[i].nama;
                thargaSatuan.innerHTML = daftarBarang[i].harga;
                tjumlahBarang.innerHTML = daftarBarang[i].jumlah;
                tsubHarga.innerHTML = daftarBarang[i].sub;
                tAction.innerHTML = '<button type="button" class="btn btn-warning m-1" onclick="edit('+ i +')">Edit</button>' +
                    '<button class="btn btn-danger m-1">Delete</button>';
            }
        }

        function totalBayar() {
            var totalHarga = 0;
            for (var i = 0; i < daftarBarang.length; i++) {
                totalHarga += daftarBarang[i].jumlah * daftarBarang[i].harga;
            }
            document.getElementById('total_harga').value = totalHarga;
        }

        function edit(id) {
            editbtn.style.display = "block";
            cancelBtn.style.display = "block";
            addBtn.style.display = "none";

        }

        function update() {

            totalBayar();
            dummy();

            editbtn.style.display = "none";
            cancelBtn.style.display = "none";
            addBtn.style.display = "block";

            document.getElementById('nama_barang').value = '';
            document.getElementById('harga_barang').value = '';
            document.getElementById('jumlah_barang').value = '';
            document.getElementById('sub_harga').value = '';
        }

        function cancel() {
            editbtn.style.display = "none";
            cancelBtn.style.display = "none";
            addBtn.style.display = "block";

            document.getElementById('nama_barang').value = '';
            document.getElementById('harga_barang').value = '';
            document.getElementById('jumlah_barang').value = '';
            document.getElementById('sub_harga').value = '';
        }

        function dummy() {
            const dummy = document.getElementById('daftar_barang').value = JSON.stringify(daftarBarang);
            return dummy;
        }

    </script>
@endsection
