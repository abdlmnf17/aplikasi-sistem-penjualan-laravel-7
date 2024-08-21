@extends('layouts.layout')

@section('content')
    @include('sweetalert::alert')

    <div class="container">
        <!-- Page Heading -->
        <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800">Data Akun Rekening</h1>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addAccountModal">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </div>
    </div>

        <!-- Table Card -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light text-center">
                            <tr>
                                <th width="20%">Kode Akun</th>
                                <th>Nama Akun</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($akun as $akn)
                                <tr class="text-center">
                                    <td>{{ $akn->no_akun }}</td>
                                    <td>{{ $akn->nm_akun }}</td>
                                    <td>
                                        <a href="{{ route('akun.edit', [$akn->no_akun]) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="/akun/hapus/{{ $akn->no_akun }}" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger btn-sm">
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

        <!-- Add Account Modal -->
        <div class="modal fade" id="addAccountModal" tabindex="-1" role="dialog" aria-labelledby="addAccountModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAccountModalTitle">Tambah Data Akun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ action('AkunController@store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="addnoakun">Kode Akun</label>
                                <input type="text" name="addnoakun" id="addnoakun" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="addnmakun">Nama Akun</label>
                                <input type="text" name="addnmakun" id="addnmakun" class="form-control" required>
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
