@extends('layouts.layout')

@section('content')
    @include('sweetalert::alert')

    <!-- Header and Add Button -->
    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800">Data Menu</h1>
            <button type="button" class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#addMenuModal">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>Kode Menu</th>
                            <th>Nama Menu</th>
                            <th>Harga Menu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menu as $mnu)
                            <tr class="text-center">
                                <td>{{ $mnu->kd_mnu }}</td>
                                <td>{{ $mnu->nm_mnu }}</td>
                                <td>Rp. {{ number_format($mnu->harga, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('menu.edit', [$mnu->kd_mnu]) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="/menu/hapus/{{ $mnu->kd_mnu }}"
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

    <!-- Modal Add Menu -->
    <div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-labelledby="addMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMenuModalLabel">Tambah Data Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ action('menuController@store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kodeMenu">Kode Menu</label>
                            <input type="text" name="addkdmnu" id="kodeMenu" class="form-control" maxlength="5" required>
                        </div>
                        <div class="form-group">
                            <label for="namaMenu">Nama Menu</label>
                            <input type="text" name="addnmmnu" id="namaMenu" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="hargaMenu">Harga Menu</label>
                            <input type="number" name="addharga" id="hargaMenu" class="form-control" required>
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
@endsection
