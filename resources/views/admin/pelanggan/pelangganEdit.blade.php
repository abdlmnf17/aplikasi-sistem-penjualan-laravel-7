@extends('layouts.layout')
@section('content')
<form action="{{route('pelanggan.update', [$pelanggan->kd_pel])}}" method="POST">
          @csrf
          <input type="hidden" name="_method" value="PUT">
          <fieldset>
                    <legend>Ubah Data Pelanggan</legend>
                    <div class="form-group row">
                              <div class="col-md-5">
                                        <label for="addkd_pel">Kode Pelanggan</label>
                                        <input class="form-control" type="text" name="addkd_pel" value="{{$pelanggan->kd_pel}}" readonly>
                              </div>
                              <div class="col-md-5">
                                        <label for="addnm_cost">Nama Pelanggan</label>
                                        <input id="addnm_pel" type="text" name="addnm_pel" class="form-control" value="{{$pelanggan->nm_pel}}" required>
                              </div>
                    </div>
                    <div class="form-group row"> 
                              <div class="col-md-5">
                                        <label for="telepon">Telepon</label>
                                        <input id="addtelepon" type="text" name="telepon" class="form-control" value="{{$pelanggan->telepon}}" required>
                              </div>
                    </div>
          </fieldset>
          <div class="col-md-10">
                    <input type="submit" class="btn btn-success btn-send" value="Update">
                    <a href="{{ route('pelanggan.index') }}"><input type="Button" class="btn btn-primary btn-send" value="Kembali"></a>
          </div>
          <hr>
</form>
@endsection