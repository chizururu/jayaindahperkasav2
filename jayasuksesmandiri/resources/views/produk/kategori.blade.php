@extends('layouts.main')
@section('title-page', 'Kategori')
@section('title', 'Kategori')
@section('content')
    <a href="{{ url('/produk') }}" class="btn btn-warning m-2"><i class="bi bi-arrow-90deg-left"></i><span class="badge badge-secondary">Kembali</span></a>
    <div class="pagetitle">
        <h1>Kategori</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-0">Tabel Kategori</h5>
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKategori">
                            Tambah Kategori
                        </button>
                    </div>
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($kategori as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->kategori }}</td>
                                <td>
                                    <button class="btn btn-warning m-2" data-bs-toggle="modal" data-bs-target="#editKategori{{ $data->id }}"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-danger m-2" data-bs-toggle="modal" data-bs-target="#deleteKategori{{ $data->id }}">
                                        <i class="bi bi-trash2-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Barang -->
    <div class="modal fade" id="addKategori" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Kategori</h5>
                </div>
                <div class="modal-body">
                    <form id="addKategori" action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3 mb-2">
                            <div class="col col-sm-3">
                                <label for="kategori" class="form-label">Kategori</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="kategori">
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Barang -->
    @foreach($kategori as $data)
        <div class="modal fade" id="editKategori{{ $data->id }}" tabindex="-1" data-bs-backdrop="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kategori</h5>
                    </div>
                    <div class="modal-body">
                        <form id="editKategori{{ $data->id }}" action="{{ route('kategori.update', ['kategori' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-3 mb-2">
                                <div class="col col-sm-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="kategori" value="{{ $data->kategori }}">
                                </div>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="submit" class="btn btn-primary">Simpan dan Ubah Kategori </button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Delete Barang --}}
    @foreach($kategori as $data)
        <div class="modal fade" id="deleteKategori{{ $data->id }}" tabindex="-1" data-bs-backdrop="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Kategori</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kategori.destroy', $data->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-2">
                                <p class="text-center"> Apakah anda ingin menghapus kategori : <span class="font-bold">{{ $data->kategori }}</span></p>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="submit" class="btn btn-danger">
                                    Ya, Hapus Kategori
                                </button>
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
        document.getElementById('addKategori').addEventListener('hidden.bs.modal', function () {
            document.getElementById('addForm').reset();
        });
    </script>
    {{-- Edit Barang --}}
    @foreach($kategori as $data)
        <script>
            document.getElementById('editKategori{{ $data->id }}').addEventListener('hidden.bs.modal', function () {
                document.getElementById('editForm{{ $data->id }}').reset();
            });
        </script>
    @endforeach
@endsection
