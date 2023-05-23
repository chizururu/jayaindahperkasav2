@extends('layout')
@section('title-page', 'Inventaris')
@section('title', 'Kategori')
@section('content')
    <div class="pagetitle">
        <h1>Kategori</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-0">Tabel Kategori</h5>
                    <div class="py-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKategori">
                            Tambah Barang
                        </button>
                    </div>
                    <table class="table datatable table-bordered border-primary">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kategori as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->kategori }}</td>
                                    <td>{{$data->deskripsi}}</td>
                                    <td>
                                        <button class="btn btn-warning m-2" data-bs-toggle="modal" data-bs-target="#editKategori{{ $data->id }}">Edit</button>
                                        <button class="btn btn-danger m-2" data-bs-toggle="modal" data-bs-target="#deleteKategori{{ $data->id }}">
                                            Delete Kategori
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
                    <button type="button" class="btn-close" data-bs-dimiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3 mb-2">
                            <div class="col col-sm-3">
                                <label for="kategori" class="form-label">Kategori</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="kategori">
                            </div>
                        </div>
                        <div class="row g-3 mb-2">
                            <div class="col col-sm-3">
                                <label for="deskripsi" class="col-sm-4 col-form-label">Deskripsi</label>
                            </div>
                            <div class="col">
                                <div class="col">
                                    <textarea name="deskripsi" class="form-control" style="height: 100px"></textarea>
                                </div>
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
    </div>

    <!-- Edit Barang -->
    @foreach($kategori as $data)
        <div class="modal fade" id="editKategori{{ $data->id }}" tabindex="-1" data-bs-backdrop="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dimiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3 mb-2">
                                <div class="col col-sm-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="kategori" value="{{ $data->kategori }}">
                                </div>
                            </div>
                            <div class="row g-3 mb-2">
                                <div class="col col-sm-3">
                                    <label for="deskripsi" class="col-sm-4 col-form-label">Deskripsi</label>
                                </div>
                                <div class="col">
                                    <div class="col">
                                        <textarea name="deskripsi" class="form-control" style="height: 100px" value="{{ $data->deskripsi }}"></textarea>
                                    </div>
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
        </div>
    @endforeach

    {{-- Delete Barang --}}
    @foreach($kategori as $data)
        <div class="modal fade" id="deleteKategori{{ $data->id }}" tabindex="-1" data-bs-backdrop="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                    Delete
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
