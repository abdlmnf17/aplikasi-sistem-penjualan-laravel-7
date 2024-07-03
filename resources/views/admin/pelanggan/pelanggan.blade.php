@extends('layouts.layout')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Data Pelanggan</h1>
</div>
<hr>
<div class="card-header py-3" align="right">
          <button type="button" class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#exampleModalScrollable">
                    <i class="fas fa-plus"></i> Tambah</button>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
          <div class="card-body">
                    <div class="table-responsive">
                              <table class="table table-bordered tablestriped" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="thead-dark" align="center">
                                                  <tr align="center">
                                                            <th>Kode Pelanggan</th>
                                                            <th>Nama Pelanggan</th>
                                                            <th>No Telepon</th>
                                                            <th>Aksi</th>
                                                  </tr>
                                        </thead>
                                        <tbody>
                                                  @foreach($pelanggan as $pel)
                                                  <tr align="center">
                                                            <td>{{ $pel->kd_pel}}</td>
                                                            <td>{{ $pel->nm_pel}}</td>
                                                            <td>{{ $pel->telepon}}</td>
                                                            <td><a href="{{route('pelanggan.edit',[$pel->kd_pel])}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                                                                <i class="fas fa-edit fa-sm text-white-50"></i> Edit</a>
                                                                      <a href="/pelanggan/hapus/{{$pel->kd_pel}}" onclick="return confirm('Yakin Ingin menghapus data?')" class="dnoned-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                                                                <i class="fas fa-trash-alt fa-sm text-white-50"></i> Hapus</a>
                                                            </td>
                                                  </tr>
                                                  @endforeach
                                        </tbody>
                              </table>
                    </div>
          </div>
</div>
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                              <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Data Pelanggan</h5>
                                        <button type="button" class="close" data-dismiss="modal" arialabel="Close">
                                                  <span aria-hidden="true">&times;</span>
                                        </button>
                              </div>
                              <form action="{{ action('pelangganController@store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                                  <div class="form-group">
                                                            <label for="exampleFormControlInput1">Kode Pelanggan</label>
                                                            <input type="text" name="addkd_pel" id="addkd_pel" class="form-control" maxlegth="5" id="exampleFormControlInput1" required>
                                                  </div>
                                                  <div class="form-group">
                                                            <label for="exampleFormControlInput1">Nama Pelanggan</label>
                                                            <input type="text" name="addnm_pel" id="addnm_pel" class="form-control" id="exampleFormControlInput1" required>
                                                  </div>
                                                  <div class="form-group">
                                                            <label for="exampleFormControlInput1">No Telepon</label>
                                                            <input type="text" name="addtelepon" id="addtelepon" class="form-control" id="exampleFormControlInput1" required>
                                                  </div>
                                        </div>
                                        <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                  <input type="submit" class="btn btn-primary btn-send" value="Simpan">
                                        </div>
                    </div>
                    </form>
          </div>
</div>
@endsection