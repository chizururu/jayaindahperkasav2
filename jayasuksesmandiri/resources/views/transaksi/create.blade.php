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

                console.log(value);

                if (value === '') {
                    row.querySelector('[name="harga_barang[]"]').value = '';
                    row.querySelector('[name="stok_barang[]"]').value = '';
                    row.querySelector('[name="jumlah_barang[]"]').value = '';
                } else {
                    row.querySelector('[name="harga_barang[]"]').value = hargaBarang;
                    row.querySelector('[name="stok_barang[]"]').value = stokBarang;
                }
            });
        }

        // Fungsi Menghitung subharga dan total bayar
        function hitungHarga() {
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

        /*Hapus Barang*/
        function deleteRow(button) {
            const row = button.closest('tr');
            row.remove();
            // Update harga ketika user menghapus barang
            hitungHarga();
        }

        /*Simpan Barang*/
        function save() {
            const selectionBarang = document.querySelectorAll('[for="nama_barang[]"]');
            const inputStokBarang = document.querySelectorAll('[name="stok_barang[]"]');
            const inputJumlah = document.querySelectorAll('[name="jumlah_barang[]"]');
            const inputHarga = document.querySelectorAll('[name="harga_barang[]"]');
            const inputSubHarga = document.querySelectorAll('[name="sub_harga[]"]');
            const deletebtn = document.querySelectorAll("#deletebtn");

            selectionBarang.forEach(function (elem, index) {
                const idbarang = selectionBarang[index].value;
                const stokBarang = inputStokBarang[index].value;
                const jumlah = inputJumlah[index].value;
                const harga = inputHarga[index].value
                const subHarga = inputSubHarga[index].value;

                if (idbarang === '') {
                    alertNotification.innerHTML = '<div class="alert alert-danger alert-dismissible fade show m-4" role="alert">'+
                        '<strong>Error!</strong> Tidak Dapat Menyimpan Keranjang Barang. Pastikan Setiap Field Nama Barang dan Jumlah Barang Terisi.'
                        +'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
                        +'</div>'
                    selectionBarang[index].classList.add('error');

                    addButton.style.display = "block";
                    saveButton.style.display = "block";
                    cancelButton.style.display = "none";
                    simpanTransaksi.disabled = true;
                } else if (isNaN(parseInt(jumlah))||parseInt(jumlah) <= 0 ||parseInt(jumlah) > parseInt(stokBarang)) {
                    // Notofikasi Error
                    alertNotification.innerHTML = '<div class="alert alert-danger alert-dismissible fade show m-4" role="alert">'+
                        '<strong>Error!</strong> Tidak Dapat Menyimpan Keranjang Barang. Pastikan Setiap Field Nama Barang dan Jumlah Barang Terisi.'
                        +'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
                        +'</div>'

                    inputJumlah[index].classList.add('error');

                    addButton.style.display = "block";
                    saveButton.style.display = "block";
                    cancelButton.style.display = "none";
                    simpanTransaksi.disabled = "true";
                } else {
                    elem.disabled = true;
                    console.log(idbarang);
                    console.log(stokBarang);
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

                    selectionBarang[index].classList.remove('error');
                    inputJumlah[index].classList.remove('error');

                    alertNotification.innerHTML = '<div class="alert alert-success alert-dismissible fade show m-4" role="alert">'+
                        '<strong>Saved!</strong> Keranjang Barang Telah Disimpan.'
                        +'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
                        +'</div>'

                    addButton.style.display = "none";
                    saveButton.style.display = "none";
                    cancelButton.style.display = "block";
                    simpanTransaksi.disabled = false;


                    inputJumlah.forEach(function (elem) {
                        elem.disabled = true;
                    });

                    inputHarga.forEach(function (elema) {
                        elem.disabled = true;
                    });

                    inputSubHarga.forEach(function (elem) {
                        elem.disabled = true;
                    });

                    deletebtn.forEach(function (elem) {
                        elem.disabled = true;
                    });
                }
            });
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
            simpanTransaksi.disabled = false;

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
