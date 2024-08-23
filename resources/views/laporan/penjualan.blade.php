@extends('layouts.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card mb-4">
                    <!-- Logo Perusahaan dan Keterangan -->
                    <div class="card-body d-flex justify-content-between align-items-center">


                        <h4 class="text-muted">Laporan Penjualan</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.penjualancetak') }}" method="get">
                        <label for="tanggal_awal">Tanggal Awal:</label>
                        <input type="date" id="tanggal_awal" name="tanggal_awal">

                        <label for="tanggal_akhir">Tanggal Akhir:</label>
                        <input type="date" id="tanggal_akhir" name="tanggal_akhir">

                        <button type="submit" class="btn btn-info btn-send">Tampilkan Laporan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
