@extends('layouts.layout')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Penjualan </h1>
    </div>
    <hr>
    <form action="/penjualan/simpan" method="POST">
        @csrf
        <div class="form-group col-sm-4">
            <label for="exampleFormControlInput1">No Penjualan</label>
            @foreach ($kas as $ks)
                <input type="hidden" name="akun" value="{{ $ks->no_akun }}" class="form-control"
                    id="exampleFormControlInput1">
            @endforeach
            @foreach ($penjualan as $jual)
                <input type="hidden" name="penjualan" value="{{ $jual->no_akun }}" class="form-control"
                    id="exampleFormControlInput1">
            @endforeach
            <input type="hidden" name="no_jurnal" value="{{ $formatj }}" class="form-control"
                id="exampleFormControlInput1">
            <input type="text" name="no_faktur" value="{{ $format }}" class="form-control"
                id="exampleFormControlInput1">
        </div>
        @foreach ($pemesanan as $psn)
            <div class="form-group col-sm-4">
                <label for="exampleFormControlInput1">No Pemesanan</label>
                <input type="text" name="no_pesan" value="{{ $psn->no_pesan }}" class="form-control"
                    id="exampleFormControlInput1">
            </div>
            <div class="form-group col-sm-4">
                <label for="exampleFormControlInput1">Tanggal Pemesanan</label>
                <input type="text" min="1" name="tgl" value="{{ $psn->tgl_pesan }}" class="form-control"
                    id="exampleFormControlInput1">
            </div>
        @endforeach
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered tablestriped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr align="center">
                                <th>Kode Menu</th>
                                <th>Nama Menu</th>
                                <th>Quantity</th>
                                <th>Sub Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($total = 0)
                            @foreach ($detail as $temp)
                                <tr align = "center">
                                    <td><input name="no_jual[]" class="form-control" type="hidden"
                                            value="{{ $temp->no_pesan }}" readonly><input name="kd_mnu[]"
                                            class="formcontrol" type="hidden" value="{{ $temp->kd_mnu }}"
                                            readonly>{{ $temp->kd_mnu }}</td>
                                    <td>{{ $temp->nm_mnu }}</td>
                                    <td><input name="qty_jual[]" class="form-control" type="hidden"
                                            value="{{ $temp->qty_pesan }}" readonly>{{ $temp->qty_pesan }}</td>
                                    <td><input name="sub_jual[]" class="form-control" type="hidden"
                                            value="{{ $temp->sub_total }}" readonly>Rp.
                                        {{ number_format($temp->sub_total) }}</td>
                                    <td>
                                        <a href="/transaksi/hapus/{{ $temp->kd_mnu }}"
                                            onclick="return confirm('Yakin Ingin menghapus data?')"
                                            class="dnoned-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                            <i class="fas fa-trash-alt fa-sm text-white-50"></i> Hapus</a>
                                    </td>
                                </tr>
                                @php($total += $temp->sub_total)
                            @endforeach
                            <tr align = "center">
                                <td colspan="3"></td>
                                <td><input name="total" class="form-control" type="hidden"
                                        value="{{ $total }}">Total Rp. {{ number_format($total) }}</a>
                                <td></td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <input type="submit" class="btn btn-primary btn-send" value="Simpan Penjualan">
            </div>
        </div>
    </form>
@endsection
