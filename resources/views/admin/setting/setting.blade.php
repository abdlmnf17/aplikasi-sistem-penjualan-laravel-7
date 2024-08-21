@extends('layouts.layout')

@section('content')
    @include('sweetalert::alert')

    <div class="container">
        <!-- Page Heading -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-secondary">Setting Akun untuk Transaksi</h1>
        </div>

        <!-- Form Card -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="/setting/simpan" method="POST">
                    @csrf

                    @foreach ($setting as $stg)
                        <div class="row mb-3">
                            <input type="hidden" name="kode[]" value="{{ $stg->id_setting }}">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="transaksi_{{ $stg->id_setting }}">Transaksi {{ $stg->nama_transaksi }}</label>
                                    <input type="text" class="form-control" value="{{ $stg->no_akun }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="akun_{{ $stg->id_setting }}">Pilih Akun</label>
                                    <select name="akun[]" id="akun_{{ $stg->id_setting }}" class="form-control" required>
                                        <option value="">Pilih Akun</option>
                                        @foreach ($akun as $akn)
                                            <option value="{{ $akn->no_akun }}">{{ $akn->no_akun }} - {{ $akn->nm_akun }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update Setting</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
