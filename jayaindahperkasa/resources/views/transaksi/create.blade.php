@extends('layout')
@section('title-page', 'Transaksi')
@section('title', 'Form Transaksi')
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
        <!--Testing-->
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
                <button type="button" id="addbtn" class="btn btn-primary" onclick="addRow()">Add Row</button>
                <div class="d-flex justify-content-center">
                    <div class="m-2">
                        <button type="button" id="savebtn" class="btn btn-success" onclick="save()">Save</button>
                        <button type="button" id="cancelbtn" class="btn btn-danger" onclick="cancel()">Cancel</button>
                    </div>
                </div>
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
                        <button type="submit" id="simpan" class="btn btn-primary">Simpan Transaksi</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        let daftarBarang = [];
        const addtrans = document.getElementById("simpan");
        addtrans.disabled = true;

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
            tjumlahBarang.innerHTML = '<input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang[]" onkeyup="addField(this)">';
            tsubHarga.innerHTML = '<input type="number" class="form-control" id="sub_harga" name="sub_harga[]" onkeyup="addField(this)" readonly>';
            taction.innerHTML = '<button id="deletebtn" type="button" class="btn btn-danger" onclick="deleteRow(this)">Delete</button>';

            const selection = row.querySelector('#nama_barang');
            selection.addEventListener('change', function () {
                const selectionOption = this.options[this.selectedIndex];
                hargaBarang = selectionOption.getAttribute('harga-jual');
                row.querySelector('[name="harga_barang[]"]').value = hargaBarang;
            });

        }

        function addField() {
            const inputJumlah = document.querySelectorAll('[name="jumlah_barang[]"]');
            const inputHarga = document.querySelectorAll('[name="harga_barang[]"]');
            const inputSubHarga = document.querySelectorAll('[name="sub_harga[]"]');
            const totalHargaFields = document.querySelectorAll('#total_harga');

            let totalHarga = 0;

            inputJumlah.forEach(function (el, index) {
                const jumlah = el.value;
                const harga = inputHarga[index].value;
                const subHarga = jumlah * harga;
                inputSubHarga[index].value = subHarga;

                totalHarga += subHarga;
            });

            totalHargaFields.forEach(function (el) {
               el.value = totalHarga;
            });
        }


        function deleteRow(button) {
            const row = button.closest('tr');
            const index = row.rowIndex - 1;

            row.remove();
        }

        function save() {
            const selectionBarang = document.querySelectorAll('[for="nama_barang[]"]');
            const inputJumlah = document.querySelectorAll('[name="jumlah_barang[]"]');
            const inputHarga = document.querySelectorAll('[name="harga_barang[]"]');
            const inputSubHarga = document.querySelectorAll('[name="sub_harga[]"]');
            const addbtn = document.getElementById("addbtn");
            const deletebtn = document.querySelectorAll("#deletebtn");

            addbtn.disabled = true;
            addtrans.disabled = false;

            selectionBarang.forEach(function (elem, index) {
                elem.disabled = true;

                const idbarang = selectionBarang[index].value;
                const jumlah = inputJumlah[index].value;
                const harga = inputHarga[index].value
                const subHarga = inputSubHarga[index].value;

                console.log(idbarang);
                console.log(jumlah);
                console.log(harga);
                console.log(subHarga);

                const barang = {
                    id: idbarang,
                    jumlah: jumlah,
                    harga: harga,
                    subharga: subHarga,
                }
                daftarBarang.push(barang);
            });

            inputJumlah.forEach(function (elem) {
                elem.disabled = true;
            });

            inputHarga.forEach(function (elem) {
                elem.disabled = true;
            });

            inputSubHarga.forEach(function (elem) {
                elem.disabled = true;
            });

            deletebtn.forEach(function (elem) {
                elem.disabled = true;
            });
            storageData();
            console.log(daftarBarang)
        }

        function cancel() {
            const selectionBarang = document.querySelectorAll('[for="nama_barang[]"]');
            const inputJumlah = document.querySelectorAll('[name="jumlah_barang[]"]');
            const inputHarga = document.querySelectorAll('[name="harga_barang[]"]');
            const inputSubHarga = document.querySelectorAll('[name="sub_harga[]"]');
            const addbtn = document.getElementById("addbtn");
            const deletebtn = document.querySelectorAll("#deletebtn");

            console.log(addtrans);
            addbtn.disabled = false;
            addtrans.disabled = true;

            daftarBarang = [];
            console.log(daftarBarang);
            selectionBarang.forEach(function (elem) {
                elem.disabled = false;
            });

            inputJumlah.forEach(function (elem) {
                elem.disabled = false;
            });

            inputHarga.forEach(function (elem) {
                elem.disabled = false;
            });

            inputSubHarga.forEach(function (elem) {
                elem.disabled = false;
            });

            deletebtn.forEach(function (elem) {
                elem.disabled = false;
            });

        }

        function subTotal(input) {
        }

        function storageData() {
            const storage = document.getElementById('daftar_barang').value = JSON.stringify(daftarBarang);

            return storage;
        }
    </script>
@endsection
