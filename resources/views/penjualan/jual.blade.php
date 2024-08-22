@extends('layouts.layout')

@section('content')
    @include('sweetalert::alert')

    <div class="container">
        <!-- Page Heading -->
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">Detail Transaksi Penjualan</h1>
            </div>
        </div>
        <hr>

        <!-- Form -->
        <form action="/penjualan/simpan" method="POST">
            @csrf

            <div class="row justify-content-center mb-4">
                @foreach ($pemesanan as $psn)
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama">Nama Pelanggan</label>
                            <input type="text" name="nama" value="{{ $psn->nama_pelanggan }}" class="form-control" id="nama">
                        </div>
                    </div>
                @endforeach

                @foreach ($metode as $m)
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="metode">Metode Pembayaran</label>
                            <input type="text" name="metode" value="{{ $m->metode_pembayaran }}" class="form-control" id="metode">
                        </div>
                    </div>
                @endforeach

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="no_faktur">No Penjualan</label>
                        @foreach ($kas as $ks)
                            <input type="hidden" name="akun" value="{{ $ks->no_akun }}" class="form-control">
                        @endforeach
                        @foreach ($penjualan as $jual)
                            <input type="hidden" name="penjualan" value="{{ $jual->no_akun }}" class="form-control">
                        @endforeach
                        <input type="hidden" name="no_jurnal" value="{{ $formatj }}" class="form-control">
                        <input type="text" name="no_faktur" value="{{ $format }}" class="form-control" id="no_faktur">
                    </div>
                </div>

                @foreach ($pemesanan as $psn)
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="no_pesan">No Pemesanan</label>
                            <input type="text" name="no_pesan" value="{{ $psn->no_pesan }}" class="form-control" id="no_pesan">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tgl">Tanggal Pemesanan</label>
                            <input type="text" name="tgl" value="{{ $psn->tgl_pesan }}" class="form-control" id="tgl">
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Table -->
            <div class="card mx-auto" style="max-width: 1000px;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th>Kode Menu</th>
                                    <th>Nama Menu</th>
                                    <th>Quantity</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($total = 0)
                                @foreach ($detail as $temp)
                                    <tr class="text-center">
                                        <td>
                                            <input name="no_jual[]" type="hidden" value="{{ $temp->no_pesan }}" readonly>
                                            <input name="kd_mnu[]" type="hidden" value="{{ $temp->kd_mnu }}" readonly>
                                            {{ $temp->kd_mnu }}
                                        </td>
                                        <td>{{ $temp->nm_mnu }}</td>
                                        <td>
                                            <input name="qty_jual[]" type="hidden" value="{{ $temp->qty_pesan }}" readonly>
                                            {{ $temp->qty_pesan }}
                                        </td>
                                        <td>
                                            <input name="sub_jual[]" type="hidden" value="{{ $temp->sub_total }}" readonly>
                                            Rp. {{ number_format($temp->sub_total) }}
                                        </td>
                                    </tr>
                                    @php($total += $temp->sub_total)
                                @endforeach
                                <tr class="text-center">
                                    <td colspan="3">Total</td>
                                    <td>
                                        <input name="total" type="hidden" value="{{ $total }}">
                                        Rp. {{ number_format($total) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Penjualan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
