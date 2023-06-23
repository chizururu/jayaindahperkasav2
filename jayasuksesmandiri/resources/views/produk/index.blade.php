@extends('layouts.main')
@section('title-page', 'Inventaris')
@section('title', 'Inventaris')

@section('content')
    <a href="{{ url('/') }}" class="btn btn-warning m-2"><i class="bi bi-arrow-90deg-left"></i><span class="badge badge-secondary">Beranda</span></a>

    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-0">Daftar Barang</h5>
                    @if(session()->has('info-add'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ session()->get('info-add') }}
                        </div>
                    @endif
                    @if(session()->has('info-update'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ session()->get('info-update') }}
                        </div>
                    @endif
                    @if(session()->has('info-delete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ session()->get('info-delete') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <h7 class="mb-3">Kesalahan Tidak Dapat Menginput Barang</h7>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                        </div>
                    @endif
                    <div class="py-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBarang">
                            Add Barang
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
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($produks as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama_barang }}</td>
                                <td>{{ $data->kategori->kategori }}</td>
                                <td>{{ $data->jumlah_stok }}</td>
                                <td>{{ $data->harga_beli }}</td>
                                <td>{{ $data->harga_jual }}</td>
                                <td>{{ $data->satuan }}</td>
                                <td>
                                    @if($data->jumlah_stok > 0)
                                        <span class="badge bg-success">Masih Ada</span>
                                    @else
                                        <span class="badge bg-danger">Stok Habis</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('produk/'. $data->id) }}" class="btn btn-light m-2"><i class="bi bi-journal-check"></i></a>
                                    <button class="btn btn-warning m-2" data-bs-toggle="modal" data-bs-target="#editBarang{{ $data->id }}"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-danger m-2" data-bs-toggle="modal" data-bs-target="#deleteBarang{{ $data->id }}"><i class="bi bi-trash2-fill"></i></button></td>
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
                </div>
                <div class="modal-body">
                    <form id="addForm" action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
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
                                <label for="kategori_id" class="form-label">Kategori</label>
                            </div>
                            <div class="col">
                                <select class="form-select" name="kategori_id">
                                    <option value="">Pilih Barang</option>
                                    @foreach($kategoris as $kate)
                                        <option value="{{ $kate->id }}">{{ $kate->kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 p-2">
                            <div class="col">
                                <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="jumlah_stok"
                                >
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
                                <label for="harga_beli" class="form-label">Harga Beli</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="harga_beli">
                            </div>
                            <div class="col">
                                <label for="harga_jual" class="form-label">Harga Jual</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="harga_jual">
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" class="btn btn-primary">Simpan Barang</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End Disabled Backdrop Modal-->

    {{-- Edit Barang --}}
    @foreach($produks as $data)
        <div class="modal fade" id="editBarang{{ $data->id }}" tabindex="-1" data-bs-backdrop="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Barang</h5>
                    </div>
                    <div class="modal-body">
                        <form  id="editForm{{ $data->id }}" action="{{ route('produk.update' , ['produk' => $data->id ]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-3 p-2">
                                <div class="col col-sm-3">
                                    <label for="nama_barang"class="form-label">Nama Barang</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="nama_barang" value="{{ $data->nama_barang }}">
                                </div>
                            </div>
                            <div class="row g-3 p-2">
                                <div class="col col-sm-3">
                                    <label for="kategori_id" class="form-label">Kategori</label>
                                </div>
                                <div class="col">
                                    <select class="form-select" name="kategori_id">
                                        <option value="">Pilih Barang</option>
                                        @foreach($kategoris as $kate)
                                            <option value="{{ $kate->id }}" {{ $kate->id == $data->kategori_id ? 'selected' : '' }}>{{ $kate->kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 p-2">
                                <div class="col">
                                    <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="jumlah_stok" value="{{ $data->jumlah_stok }}">
                                </div>
                                <div class="col">
                                    <label for="satuan" class="form-label">Satuan</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="satuan" value="{{ $data->satuan }}">
                                </div>
                            </div>
                            <div class="row g-3 p-2">
                                <div class="col">
                                    <label for="harga_beli" class="form-label">Harga Beli</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="harga_beli" value="{{ $data->harga_beli }}">
                                </div>
                                <div class="col">
                                    <label for="harga_jual" class="form-label">Harga Jual</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="harga_jual" value="{{ $data->harga_jual }}">
                                </div>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="submit" class="btn btn-primary">Simpan dan Ubah Barang</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- End Disabled Backdrop Modal-->
    @endforeach
    {{-- Delete Barang --}}
    @foreach($produks as $data)
        <div class="modal fade" id="deleteBarang{{ $data->id }}" tabindex="-1" data-bs-backdrop="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Barang</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('produk.destroy', $data->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-2">
                                <p class="text-center">Apakah anda ingin menghapus - <span class="font-bold">{{ $data->nama_barang }}</span></p>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="submit" class="btn btn-danger">Ya, Hapus Barang</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- Javascipt --}}
    <script>
        {{-- Add Barang --}}
        document.getElementById('addBarang').addEventListener('hidden.bs.modal', function () {
            document.getElementById('addForm').reset();
        });
    </script>
    {{-- Edit Barang --}}
    @foreach($produks as $data)
        <script>
            document.getElementById('editBarang{{ $data->id }}').addEventListener('hidden.bs.modal', function () {
                document.getElementById('editForm{{ $data->id }}').reset();
            });
        </script>
    @endforeach
@endsection
