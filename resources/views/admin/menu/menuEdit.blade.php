@extends('layouts.layout')

@section('content')
    <div class="container">
        <!-- Update Form Card -->
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-header">
                <h5 class="card-title">Ubah Data Menu</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('menu.update', [$menu->kd_mnu]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="addkdmnu">Kode Menu</label>
                        <input type="text" id="addkdmnu" name="addkdmnu" class="form-control" value="{{ $menu->kd_mnu }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="addnmmnu">Nama Menu</label>
                        <input type="text" id="addnmmnu" name="addnmmnu" class="form-control" value="{{ $menu->nm_mnu }}" required>
                    </div>

                    <div class="form-group">
                        <label for="addharga">Harga</label>
                        <input type="number" id="addharga" name="addharga" class="form-control" value="{{ $menu->harga }}" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('menu.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
