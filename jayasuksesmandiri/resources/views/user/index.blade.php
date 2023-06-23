@extends('layouts.main')
@section('title-page', 'Karyawan')
@section('title', 'Karyawan')
@section('content')
    <a href="{{ url('/') }}" class="btn btn-warning m-2"><i class="bi bi-arrow-90deg-left"></i><span class="badge badge-secondary">Kembali</span></a>
    <hr>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Karyawan</h5>
                        <!-- Table with stripped rows -->
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
                                <h7 class="mb-3">Kesalahan Tidak Dapat Menginput Karyawan</h7>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="py-2">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBarang">
                                Add Pekerja
                            </button>
                        </div>
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->password }}</td>
                                        <td>
                                            @if($item->status == 0)
                                                <span class="badge bg-danger">Non Karyawan</span>
                                            @elseif($item->status == 1)
                                                <span class="badge bg-primary">Karyawan</span>
                                            @else
                                                <span class="badge bg-success">Pimpinan</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-warning m-2" data-bs-toggle="modal" data-bs-target="#editkaryawan{{ $item->id }}"><i class="bi bi-pencil-square"></i></button>
                                            @if($item->email !== Auth::user()->email)
                                                <button class="btn btn-danger m-2" data-bs-toggle="modal" data-bs-target="#deleteKaryawan{{ $item->id }}"><i class="bi bi-trash2-fill"></i></button>
                                            @else
                                                <button class="btn btn-danger m-2" data-bs-toggle="modal" data-bs-target="#deleteKaryawan{{ $item->id }}" disabled><i class="bi bi-trash2-fill"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                    <div class="modal fade" id="addBarang" tabindex="-1" data-bs-backdrop="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="addForm" action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-3 p-2">
                                            <div class="col col-sm-3">
                                                <label for="name"class="form-label">Nama Lengkap</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                        </div>
                                        <div class="row g-3 p-2">
                                            <div class="col col-sm-3">
                                                <label for="email"class="form-label">Email</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="email">
                                            </div>
                                        </div>
                                        <div class="row g-3 p-2">
                                            <div class="col col-sm-3">
                                                <label for="password"class="form-label">Password</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="password">
                                            </div>
                                        </div>
                                        <div class="row g-3 p-2">
                                            <div class="col col-sm-3">
                                                <label for="status" class="form-label">Status</label>
                                            </div>
                                            <div class="col">
                                                <select class="form-select" name="status">
                                                    <option value="">Pilih Status karyawan</option>
                                                    <option value="0">Non Karyawan</option>
                                                    <option value="1">Karyawan</option>
                                                    <option value="2">Pimpinan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="modal-footer text-center">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Disabled Backdrop Modal-->

                    @foreach($user as $item)
                        <div class="modal fade" id="editkaryawan{{ $item->id }}" tabindex="-1" data-bs-backdrop="false">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Pekerja</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editForm{{ $item->id }}" action="{{ route('karyawan.update', ['karyawan' => $item->id ] ) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row g-3 p-2">
                                                <div class="col col-sm-3">
                                                    <label for="name"class="form-label">Nama Lengkap</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" name="name" value="{{ $item->name }}">
                                                </div>
                                            </div>
                                            <div class="row g-3 p-2">
                                                <div class="col col-sm-3">
                                                    <label for="email"class="form-label">Email</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" name="email" value="{{ $item->email }}">
                                                </div>
                                            </div>
                                            <div class="row g-3 p-2">
                                                <div class="col col-sm-3">
                                                    <label for="password"class="form-label">Password</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" name="password" value="{{ $item->password }}">
                                                </div>
                                            </div>
                                            <div class="row g-3 p-2">
                                                <div class="col col-sm-3">
                                                    <label for="status" class="form-label">Status</label>
                                                </div>
                                                <div class="col">
                                                    <select class="form-select" name="status">
                                                        <option value="">Pilih Status karyawan</option>
                                                        <option value="0" {{ $item->status == '0' ? 'selected' : '' }}>Non Karyawan</option>
                                                        <option value="1" {{ $item->status == '1' ? 'selected' : '' }}>Karyawan</option>
                                                        <option value="2" {{ $item->status == '2' ? 'selected' : '' }}>Pimpinan</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="modal-footer text-center">
                                                <button type="submit" class="btn btn-primary">Simpan dan Update Karyawan</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Disabled Backdrop Modal-->
                    @endforeach

                    @foreach($user as $item)
                        <div class="modal fade" id="deleteKaryawan{{ $item->id }}" tabindex="-1" data-bs-backdrop="false">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Hapus Karyawan</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('karyawan.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="p-2">
                                                <p class="text-center">Apakah anda ingin menghapus - <span class="font-bold">{{ $item->name }}</span></p>
                                                <p class="text-center">Email : <span class="fw-bold">{{ $item->email }}</span></p>
                                            </div>
                                            <div class="modal-footer text-center">
                                                <button type="submit" class="btn btn-danger">Ya, Hapus Karyawan</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
@endsection
