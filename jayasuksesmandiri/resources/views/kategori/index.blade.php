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
                    @if(session()->has('info-add'))
                        <div id="add-alert" class="alert alert-success alert-delete">
                            <button id="alert-add-btn" type="button" class="btn-close"></button>
                            {{ session()->get('info-add') }}
                        </div>
                        <script>
                            // Add Alert
                            addAlertClose = document.getElementById("alert-add-btn");
                            add_alert = document.getElementById("add-alert");
                            addAlertClose.addEventListener('click', function () {
                                add_alert.style.display="none"
                            });
                        </script>
                    @endif
                    @if(session()->has('info-update'))
                        <div id="update-alert" class="alert alert-warning">
                            <button id="alert-update-btn" type="button" class="btn-close"></button>
                            {{ session()->get('info-update') }}
                        </div>
                        <script>
                            // Update
                            updateAlertClose = document.getElementById("alert-update-btn");
                            update_alert = document.getElementById("update-alert");

                            updateAlertClose.addEventListener('click', function () {
                                update_alert.style.display="none"
                            });
                        </script>
                    @endif
                    @if(session()->has('info-delete'))
                        <div id="delete-alert" class="alert alert-danger">
                            <button id="alert-delete-btn" type="button" class="btn-close"></button>
                            {{ session()->get('info-delete') }}
                        </div>
                        <script>
                            // Delete
                            deleteAlertClose = document.getElementById("alert-delete-btn");
                            delete_alert = document.getElementById("delete-alert");

                            deleteAlertClose.addEventListener('click', function () {
                                delete_alert.style.display="none"
                            });
                        </script>
                    @endif
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
                            <div class="row g-3 mb-2">
                                <div class="col col-sm-3">
                                    <label for="deskripsi" class="col-sm-4 col-form-label">Deskripsi</label>
                                </div>
                                <div class="col">
                                    <textarea name="deskripsi" class="form-control" style="height: 100px">{{ $data->deskripsi }}</textarea>
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
