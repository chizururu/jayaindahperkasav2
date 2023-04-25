@extends('layout')
@section('content')
    <div class="pagetitle">
        <h1>Inventaris</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-0">Daftar Barang</h5>
                    <div class="py-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBarang">
                            Tambah Barang
                        </button>
                    </div>
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Jumlah Stok</th>
                            <th scope="col">Harga Beli</th>
                            <th scope="col">Harga Jual</th>
                            <th scope="col">Satuan</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($inventaris as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama_barang }}</td>
                                    <td>{{ $data->kategori_barang }}</td>
                                    <td>{{ $data->jumlah_stok }}</td>
                                    <td>{{ $data->harga_beli }}</td>
                                    <td>{{ $data->harga_jual }}</td>
                                    <td>{{ $data->satuan }}</td>
                                    <td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteBarang{{ $data->id }}">Delete Barang</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Barang -->
    <div class="modal fade" id="addBarang" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3 p-2">
                            <div class="col col-sm-3">
                                <label for="nama_barang"class="form-label">Nama Barang</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="nama_barang">
                            </div>
                        </div>
                        <div class="row g-3 p-2">
                            <div class="col col-sm-3">
                                <label for="kategori_barang" class="form-label">Kategori</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="kategori_barang">
                            </div>
                        </div>
                        <div class="row g-3 p-2">
                            <div class="col">
                                <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="jumlah_stok">
                            </div>
                            <div class="col">
                                <label for="satuan" class="form-label">Satuan</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="satuan">
                            </div>
                        </div>
                        <div class="row g-3 p-2">
                            <div class="col">
                                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="harga_satuan">
                            </div>
                            <div class="col">
                                <label for="harga_jual" class="form-label">Harga Jual</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="harga_jual">
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End Disabled Backdrop Modal-->
    @foreach($inventaris as $data)
        <div class="modal fade" id="deleteBarang{{ $data->id }}" tabindex="-1" data-bs-backdrop="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('inventaris.destroy', $data->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-2">
                                <p class="text-center">Apakah anda ingin menghapus - <span class="font-bold">{{ $data->nama_barang }}</span></p>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
