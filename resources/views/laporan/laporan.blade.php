@extends('layouts.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="cardheader">Laporan Jurnal Penjualan</div>
                <div class="card-body">
                    <form action="/laporan/cetak" method="PUT" target="_blank">
                        @csrf
                        <fieldset>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="klasifikasi">Periode Jurnal</label>
                                    <input id="jenis" type="hidden" name="jenis" value="bukubesar" class="form-control">
                                    <select id="periode" name="periode" class="form-control">
                                        <option value="">--Pilih Periode Laporan--</option>
                                        <option value="All">Semua</option>
                                        <option value="periode">Per Periode</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="no_hp">Tanggal Awal</label>
                                    <input id="tglawal" type="date" name="tglawal" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="no_hp">Tanggal Akhir</label>
                                    <input id="tglakhir" type="date" name="tglakhir" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <input type="submit" class="btn btn-success btn-send" value="Cetak">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection