@extends('layouts.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="cardheader">Laporan Penjualan</div>
                <div class="card-body">
                    <form action="{{ route('laporan.penjualancetak') }}" method="get">
                        <label for="tanggal_awal">Tanggal Awal:</label>
                        <input type="date" id="tanggal_awal" name="tanggal_awal">

                        <label for="tanggal_akhir">Tanggal Akhir:</label>
                        <input type="date" id="tanggal_akhir" name="tanggal_akhir">

                        <button type="submit" class="btn btn-success btn-send">Tampilkan Laporan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
