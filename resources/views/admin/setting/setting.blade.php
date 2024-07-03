@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-secondary-800">Setting Akun untuk transaksi </h1>
</div>
<hr>
<form action="/setting/simpan" method="POST">
          @csrf
          @foreach ($setting as $stg)
          <div class="row col-sm-6">
                    <div class="col-sm">
                              <input type="hidden" name="kode[]" value="{{ $stg->id_setting }}">
                              <label for="exampleFormControlInput1">Transaksi {{ $stg->nama_transaksi}} </label>
                    </div>
                    <div class="col-sm">
                              <label for="exampleFormControlInput1">{{ $stg->no_akun }}</label>
                    </div>
                    <div class="col-sm">
                              <select name="akun[]" id="pell select2" class="form-control" required width="100%">
                                        <option value="">Pilih Akun</option>
                                        @foreach ($akun as $akn)
                                        <option value="{{ $akn->no_akun }}">{{ $akn->no_akun }} - {{ $akn->nm_akun }} </option>
                                        @endforeach
                              </select>
                    </div>
          </div>
          @endforeach
          <input type="submit" class="btn btn-primary btn-send" value="Update Setting">
</form>
@endsection