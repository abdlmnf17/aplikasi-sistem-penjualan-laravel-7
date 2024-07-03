@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Data Menu</h1>
</div>
<hr>
<div class="card-header py-3" align="right">
          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalScrollable">
                    <i class="fas fa-plus"></i> Tambah
          </button>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
          <div class="card-body">
                    <div class="table-responsive">
                              <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="thead-dark">
                                                  <tr align="center">
                                                            <th>Kode Menu</th>
                                                            <th>Nama Menu</th>
                                                            <th>Harga Menu</th>
                                                            <th>Aksi</th>
                                                  </tr>
                                        </thead>
                                        <tbody>
                                                  @foreach($menu as $mnu)
                                                  <tr align="center">
                                                            <td>{{ $mnu->kd_mnu}}</td>
                                                            <td>{{ $mnu->nm_mnu}}</td>
                                                            <td>{{ number_format($mnu->harga)}}</td>
                                                            <td align="center">
                                                                      <a href="{{route('menu.edit',[$mnu->kd_mnu])}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                                                                <i class="fas fa-edit fa-sm text-white-50"></i> Edit</a>
                                                                      <a href="/menu/hapus/{{$mnu->kd_mnu}}" onclick="return confirm('Yakin Ingin menghapus data?')" class="dnone d-sm-inline-block btn btn-sm btn-danger shadow-sm">
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
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Data Menu</h5>
                                        <button type="button" class="close" data-dismiss="modal" arialabel="Close">
                                                  <span aria-hidden="true">&times;</span>
                                        </button>
                              </div>
                              <form action="{{ action('menuController@store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                                  <div class="form-group">
                                                            <label for="exampleFormControlInput1">Kode Menu</label>
                                                            <input type="text" name="addkdmnu" id="addkdmnu" class="form-control" maxlegth="5" id="exampleFormControlInput1" required>
                                                  </div>
                                                  <div class="form-group">
                                                            <label for="exampleFormControlInput1">Nama Menu</label>
                                                            <input type="text" name="addnmmnu" id="addnmmnu" class="form-control" id="exampleFormControlInput1" required>
                                                  </div>
                                                  <div class="form-group">
                                                            <label for="exampleFormControlInput1">Harga Menu</label>
                                                            <input type="number" name="addharga" id="addharga" class="form-control" id="exampleFormControlInput1" required>
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