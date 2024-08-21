@extends('layouts.layout')

@section('content')
@include('sweetalert::alert')
    <div class="container">
        <!-- Page Heading -->
        <div class="card mb-4">

            <div class="card-body d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">Data Menu</h1>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCustomerModal">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
        </div>
        <!-- Table -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light text-center">
                            <tr>
                                <th>Kode Pelanggan</th>
                                <th>Nama Pelanggan</th>
                                <th>No Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelanggan as $pel)
                                <tr class="text-center">
                                    <td>{{ $pel->kd_pel }}</td>
                                    <td>{{ $pel->nm_pel }}</td>
                                    <td>{{ $pel->telepon }}</td>
                                    <td>
                                        <a href="{{ route('pelanggan.edit', [$pel->kd_pel]) }}"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="/pelanggan/hapus/{{ $pel->kd_pel }}"
                                            onclick="return confirm('Yakin ingin menghapus data?')"
                                            class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Add Customer -->
        <div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCustomerModalTitle">Tambah Data Pelanggan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ action('pelangganController@store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="addkd_pel">Kode Pelanggan</label>
                                <input type="text" name="addkd_pel" id="addkd_pel" class="form-control" maxlength="20"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="addnm_pel">Nama Pelanggan</label>
                                <input type="text" name="addnm_pel" id="addnm_pel" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="addtelepon">No Telepon</label>
                                <input type="text" name="addtelepon" id="addtelepon" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
