@extends('layouts.layout')
@section('content')
<form action="{{route('menu.update', [$menu->kd_mnu])}}" method="POST">
          @csrf
          <input type="hidden" name="_method" value="PUT">
          <fieldset>
                    <legend>Ubah Data Menu</legend>
                    <div class="form-group row">
                              <div class="col-md-5">
                                        <label for="addkdmnu">Kode Menu</label>
                                        <input class="form-control" type="text" name="addkdmnu" value="{{$menu->kd_mnu}}" readonly>
                              </div>
                              <div class="col-md-5">
                                        <label for="addnmmnu">Nama Menu</label>
                                        <input id="addnmmnu" type="text" name="addnmmnu" class="form-control" value="{{$menu->nm_mnu}}" required>
                              </div>
                    </div>
                    <div class="form-group row">
                              <div class="col-md-5">
                                        <label for="Harga">Harga</label>
                                        <input id="addharga" type="text" name="addharga" class="form-control" value="{{$menu->harga}}" required>
                              </div>
                    </div>
          </fieldset>
          <div class="col-md-10">
                    <input type="submit" class="btn btn-success btn-send" value="Update">
                    <a href="{{ route('menu.index') }}"><input type="Button" class="btn btn-primary btn-send" value="Kembali"></a>
          </div>
          <hr>
</form>
@endsection