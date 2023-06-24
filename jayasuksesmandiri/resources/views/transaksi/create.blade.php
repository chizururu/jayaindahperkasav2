@extends('layouts.main')
@section('title-page', 'Form Transaksi')
@section('title', 'Form Transaksi')
@section('content')
<a href="{{ url('/transaksi') }}" class="btn btn-warning m-2"><i class="bi bi-arrow-90deg-left"></i><span class="badge badge-secondary">Kembali</span></a>

<hr>
<form action="{{ route('transaksi.store') }}" method="POST" id="form-transaksi">
    @csrf
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h5 class="card-title m-0">Informasi Pelanggan</h5>
        </div>
        <div class="card-body mt-2">
            <div id="alertNotificationProfile"></div>
            <div class="py-4">
                <input type="hidden" name="daftar_barang" id="daftar_barang">
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Nama Pelanggan</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan">
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="no_telepon" name="no_telepon">
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-7">
                        <textarea id="alamat" name="alamat" class="form-control" style="height: 80px"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Testing-->
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h5 class="card-title m-0">Keranjang Barang</h5>
        </div>
        <div id="alert-info"></div>

        <div class="card-body mt-2">
            <table id="tabel-barang" class="table">
                <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Satuan Harga</th>
                    <th>Stok Barang</th>
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
            <h5 class="card-title m-0">Pembayaran</h5>
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
                    <button type="button" id="simpan" class="btn btn-primary" onclick="simpanTransaksiPost()">Simpan Transaksi</button>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
    .error {
        border-color: red;
    }
</style>

<script>
    let daftarBarang = []; // rencana ingin menggunaan json untuk menampilkan daftar barang ketika gagal validasi melalui session
    // jadi ketika gagal masih menyimpan barang jadi bisa nampil daftar barang tanpa reset
    /* Inisialisasi Button */
    // Buat objek untuk melacak item-barang yang sudah ada
    let existingItems = [];

    const addButton = document.getElementById('addbtn');
    const saveButton = document.getElementById('savebtn');
    const cancelButton = document.getElementById('cancelbtn');
    const simpanTransaksi = document.getElementById('simpan');

    addButton.style.display = "block";
    saveButton.style.display = "block";
    cancelButton.style.display = "none";
    simpanTransaksi.disabled = true;

    /*Fungsi Add Row*/
    let alertNotification = document.getElementById('alert-info');
    function addRow() {
        /*Inisialisasi Tabel*/
        const tabel = document.getElementById('tabel-barang');
        const row = tabel.insertRow();

        const tnamaBarang = row.insertCell(0);
        const thargaSatuan = row.insertCell(1);
        const tstokBarang = row.insertCell(2);
        const tjumlahBarang = row.insertCell(3);
        const tsubHarga = row.insertCell(4);
        const taction = row.insertCell(5);

        tnamaBarang.innerHTML = '<select id="nama_barang" class="form-select" for="nama_barang[]">'+
            '<option value="">Pilih Barang</option>'+
            '@foreach($produk as $inv)'+
            '<option value="{{ $inv->id }}" nama-barang="{{ $inv->nama_barang }}" harga-jual="{{ $inv->harga_jual }}" stok-barang="{{ $inv->jumlah_stok }}">{{ $inv->nama_barang }}</option>'+
            '@endforeach'+
            '</select>';
        thargaSatuan.innerHTML = '<input type="number" class="form-control" id="harga_barang" name="harga_barang[]" disabled>';
        tstokBarang.innerHTML = '<input type="number" class="form-control" id="stok_barang" name="stok_barang[]" onkeyup="hitungHarga(this)" disabled>';
        tjumlahBarang.innerHTML = '<input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang[]" onkeyup="hitungHarga(this)">';
        tsubHarga.innerHTML = '<input type="number" class="form-control" id="sub_harga" name="sub_harga[]" onkeyup="hitungHarga(this)" readonly>';
        taction.innerHTML = '<button id="deletebtn" type="button" class="btn btn-danger" onclick="deleteRow(this)">Delete</button>';

        const selection = row.querySelector('#nama_barang');
        selection.addEventListener('change', function () {
            const selectionOption = this.options[this.selectedIndex];
            const value = selectionOption.getAttribute('value');
            const hargaBarang = selectionOption.getAttribute('harga-jual');
            const stokBarang = selectionOption.getAttribute('stok-barang');

            if (value === '') {
                row.querySelector('[name="harga_barang[]"]').value = '';
                row.querySelector('[name="stok_barang[]"]').value = '';
                row.querySelector('[name="jumlah_barang[]"]').value = '';
            } else {
                row.querySelector('[name="harga_barang[]"]').value = hargaBarang;
                row.querySelector('[name="stok_barang[]"]').value = stokBarang;

                const jumlahBarang = row.querySelector('[name="jumlah_barang[]"]').value;
                const subHarga = hargaBarang * jumlahBarang;
                row.querySelector('[name="sub_harga[]"]').value = subHarga;

                hitungTotalHarga();
            }
        });
    }

    // Fungsi Menghitung subharga dan total bayar
    function hitungHarga(input) {
        const row = input.parentNode.parentNode;
        const jumlahBarang = input.value;
        const hargaBarang = row.querySelector('[name="harga_barang[]"]').value;
        const subHarga = jumlahBarang * hargaBarang;
        row.querySelector('[name="sub_harga[]"]').value = subHarga;

        hitungTotalHarga();
    }

    function hitungTotalHarga() {
        const inputSubHarga = document.querySelectorAll('[name="sub_harga[]"]');
        let totalHarga = 0;

        inputSubHarga.forEach(function (el) {
            totalHarga += parseInt(el.value) || 0;
        });

        const totalHargaFields = document.querySelectorAll('#total_harga');
        totalHargaFields.forEach(function (el) {
            el.value = totalHarga;
        });
    }

    /*Hapus Barang*/
    function deleteRow(button) {
        const row = button.closest('tr');
        row.remove();
        // Update harga ketika user menghapus barang
        hitungTotalHarga();
    }

    /*Simpan Barang*/
    function save() {
        const selectionBarang = document.querySelectorAll('[for="nama_barang[]"]');
        const inputStokBarang = document.querySelectorAll('[name="stok_barang[]"]');
        const inputJumlah = document.querySelectorAll('[name="jumlah_barang[]"]');
        const inputHarga = document.querySelectorAll('[name="harga_barang[]"]');
        const inputSubHarga = document.querySelectorAll('[name="sub_harga[]"]');
        const deletebtn = document.querySelectorAll("#deletebtn");

        const errorList = [];
        const existingItems = {}; // Menambahkan inisialisasi existingItems

        selectionBarang.forEach(function (elem, index) {
            const idbarang = selectionBarang[index].value;
            const stokBarang = inputStokBarang[index].value;
            const jumlah = inputJumlah[index].value;
            const harga = inputHarga[index].value;
            const subHarga = inputSubHarga[index].value;

            // Reset field error
            elem.classList.remove('error');
            inputJumlah[index].classList.remove('error');

            let hasError = false;

            if (idbarang === '') {
                hasError = true;
                elem.classList.add('error');
                errorList.push('Harap pilih barang pada baris ke-' + (index + 1));
            } else if (isNaN(parseInt(jumlah)) || parseInt(jumlah) <= 0 || parseInt(jumlah) > parseInt(stokBarang)) {
                hasError = true;
                inputJumlah[index].classList.add('error');
                errorList.push('Jumlah barang pada baris ke-' + (index + 1) + ' tidak valid, pastikan input tidak kurang sama dengan 0 dan tidak boleh melebihi jumlah stok barang yang disediakan');
            } else if (checkExistingItems(idbarang, index)) { // Menambahkan pemanggilan fungsi checkExistingItems
                hasError = true;
                elem.classList.add('error');
                errorList.push('Nama barang tidak boleh sama pada baris ke-' + (index + 1));
            }

            if (!hasError) {
                existingItems[idbarang] = true;

                const barang = {
                    id: idbarang,
                    jumlah: jumlah,
                    harga: harga,
                    subharga: subHarga,
                }
                daftarBarang.push(barang);

                alertNotification.innerHTML = '<div class="alert alert-success alert-dismissible fade show m-4" role="alert">'+
                    '<strong>Saved!</strong> Keranjang Barang Telah Disimpan.'
                    +'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
                    +'</div>'

                selectionBarang.forEach(function (elem) {
                    elem.disabled = true;
                });

                inputJumlah.forEach(function (elem) {
                    elem.disabled = true;
                });

                inputHarga.forEach(function (elem) {
                    elem.disabled = true;
                });

                inputSubHarga.forEach(function (elem) {
                    elem.disabled = this;
                });

                deletebtn.forEach(function (elem) {
                    elem.disabled = this;
                });

                addButton.style.display = "none";
                saveButton.style.display = "none";
                cancelButton.style.display = "block";
                simpanTransaksi.disabled = false;
            }
        });

        if (errorList.length > 0) {
            alertNotification.innerHTML = '<div class="alert alert-danger alert-dismissible fade show m-4" role="alert">' +
                '<strong>Error!</strong><ul>' + errorList.map(function (error) {
                    return '<li>' + error + '</li>';
                }).join('') + '</ul>' +
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                '</div>';

            addButton.style.display = "block";
            saveButton.style.display = "block";
            cancelButton.style.display = "none";
            simpanTransaksi.disabled = "true";

            daftarBarang = [];

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
    }

    function checkExistingItems(idbarang, currentIndex) {
        const selectionBarang = document.querySelectorAll('[for="nama_barang[]"]');
        for (let i = 0; i < currentIndex; i++) {
            if (selectionBarang[i].value === idbarang) {
                return true;
            }
        }
        return false;
    }
    /*Batal Simpan Barang*/
    function cancel() {
        const selectionBarang = document.querySelectorAll('[for="nama_barang[]"]');
        const inputJumlah = document.querySelectorAll('[name="jumlah_barang[]"]');
        const inputHarga = document.querySelectorAll('[name="harga_barang[]"]');
        const inputSubHarga = document.querySelectorAll('[name="sub_harga[]"]');
        const deletebtn = document.querySelectorAll("#deletebtn");

        addButton.style.display = "block";
        saveButton.style.display = "block";
        cancelButton.style.display = "none";
        simpanTransaksi.disabled = true;

        daftarBarang = [];

        existingItems = [];

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
    // Save
    function simpanTransaksiPost() {
        const namaPelanggan = document.querySelector('#nama_pelanggan');
        const nomorTelepon = document.getElementById('no_telepon');
        const alamat = document.getElementById('alamat');
        const alertNotificationProfile = document.getElementById('alertNotificationProfile');

        if (namaPelanggan.value === '') {
            namaPelanggan.classList.add('error');
        } else {
            namaPelanggan.classList.remove('error');
        }

        if (nomorTelepon.value === '') {
            nomorTelepon.classList.add('error');
        } else {
            nomorTelepon.classList.remove('error');
        }

        if (alamat.value === '') {
            alamat.classList.add('error');
        } else {
            alamat.classList.remove('error');
        }

        if (namaPelanggan.value === '' || nomorTelepon.value === '' || alamat.value === '') {

            alertNotificationProfile.style.display = 'block';
            alertNotificationProfile.innerHTML = '<div class="alert alert-danger alert-dismissible fade show m-4" role="alert">'+
                '<strong>Error!</strong> Silahkan Periksa Kembali.'
                +'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
                +'</div>'
        } else {
            alertNotificationProfile.style.display = 'none';
            document.getElementById('daftar_barang').value = JSON.stringify(daftarBarang);
            const form = document.getElementById('form-transaksi');

            form.submit()
        }
    }
</script>
@endsection
