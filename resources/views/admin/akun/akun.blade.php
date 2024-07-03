@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Data Akun Rekening</h1>
</div>
<div class="card-header py-3" align="right">
          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalScrollable">
                    <i class="fas fa-plus"></i> Tambah
          </button>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
          <div class="card-body">
                    <div class="table-responsive">
                              <table class="table table-bordered tablestriped" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="thead-dark">
                                                  <tr align="center">
                                                            <th width="20%">KodeAkun</th>
                                                            <th>NamaAkun</th>
                                                            <th width="20%">Aksi</th>
                                                  </tr>
                                        </thead>
                                        <tbody>
                                                  @foreach($akun as $akn)
                                                  <tr align="center">
                                                            <td>{{$akn->no_akun}}</td>
                                                            <td>{{$akn->nm_akun}}</td>
                                                            <td align="center"><a href="{{route('akun.edit',[$akn->no_akun])}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                                                                <i class="fas fa-edit fa-sm text-white-50"></i> Edit</a>
                                                                      <a href="/akun/hapus/{{$akn->no_akun}}" onclick="return confirm('Yakin Ingin menghapus data?')" class="dnone d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                                                                <i class="fas fa-trash-alt fa-sm text-white-50"></i> Hapus</a>
                                                            </td>
                                                  </tr>
                                                  @endforeach
                                        </tbody>
                              </table>
                    </div>
          </div>
</div>
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" ariahidden="true">
          <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                              <div class="modal-header">
                                        <h5 class="modaltitle" id="exampleModalScrollableTitle">Tambah Data Akun</h5>
                                        <button type="button" class="close" data-dismiss="modal" arialabel="Close">
                                                  <span aria-hidden="true">&times;</span>
                                        </button>
                              </div>
                              <form action="{{ action('AkunController@store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                                  <div class="form-group">
                                                            <label for="exampleFormControlInput1">Kode Akun</label>
                                                            <input type="text" name="addnoakun" id="addnoakun" class="form-control" id="exampleFormControlInput1" required>
                                                  </div>
                                                  <div class="form-group">
                                                            <label for="exampleFormControlInput1">Nama Akun</label>
                                                            <input type="text" name="addnmakun" id="addnmakun" class="form-control" id="exampleFormControlInput1" required>
                                                  </div>
                                        </div>
                                        <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                  <input type="submit" class="btn btn-primary btn-send" value="Simpan">
                                        </div>
                              </form>
                    </div>
          </div>
          @endsection