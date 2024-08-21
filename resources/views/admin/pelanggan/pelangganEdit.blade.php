@extends('layouts.layout')

@section('content')
@include('sweetalert::alert')
    <div class="container">
        <!-- Update Form Card -->
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-header">
                <h5 class="card-title">Ubah Data Pelanggan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pelanggan.update', [$pelanggan->kd_pel]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <fieldset>
                        <div class="form-group">
                            <label for="addkd_pel">Kode Pelanggan</label>
                            <input type="text" id="addkd_pel" name="addkd_pel" class="form-control" value="{{ $pelanggan->kd_pel }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="addnm_pel">Nama Pelanggan</label>
                            <input type="text" id="addnm_pel" name="addnm_pel" class="form-control" value="{{ $pelanggan->nm_pel }}" required>
                        </div>

                        <div class="form-group">
                            <label for="addtelepon">Telepon</label>
                            <input type="text" id="addtelepon" name="addtelepon" class="form-control" value="{{ $pelanggan->telepon }}" required>
                        </div>
                    </fieldset>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('pelanggan.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
