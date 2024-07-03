@extends('layouts.layout')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi Pemesanan </h1>
    </div>
    <hr>
    <form action="/detail/simpan" method="POST">
        @csrf
        <div class="form-group col-sm-4">
            <label for="exampleFormControlInput1">No Faktur</label>
            <input type="text" name="no_pesan" value="{{ $formatnya }}" class="form-control" id="exampleFormControlInput1"
                readonly>
        </div>
        <div class="form-group col-sm-4">
            <label for="exampleFormControlInput1">Tanggal Transaksi</label>
            <input type="date" min="1" name="tgl" id="addnmmnu" class="form-control"
                id="exampleFormControlInput1" require>
        </div>
        <div class="form-group col-sm-4">
            <label for="exampleFormControlInput1">Pelanggan</label>
            <select name="kd_pel" id="nm_pel" class="form-control" required width="100%">
                <option value="">Pilih</option>
                @foreach ($pelanggan as $pel)
                    <option value="{{ $pel->kd_pel }}">{{ $pel->nm_pel }}</option>
                @endforeach
            </select>
        </div>
        <div class="card-header py-3" align="right">
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal"
                data-target="#exampleModalScrollable">
                <i class="fas-fa-plus fa-sm text-white-50"></i>Tambah Menu</button>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered tablestriped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr align = "center">
                                <th>Kode Menu</th>
                                <th>Nama Menu</th>
                                <th>Quantity</th>
                                <th>Sub Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($total = 0)
                            @foreach ($temp_pemesanan as $temp)
                                <tr align = "center">
                                    <td><input name="kd_mnu[]" class="form-control" type="hidden"
                                            value="{{ $temp->kd_mnu }}" readonly>{{ $temp->kd_mnu }}</td>
                                    <td><input name="nm_mnu[]" class="form-control" type="hidden"
                                            value="{{ $temp->nm_mnu }}" readonly>{{ $temp->nm_mnu }}</td>
                                    <td><input name="qty_pesan[]" class="form-control" type="hidden"
                                            value="{{ $temp->qty_pesan }}" readonly>{{ $temp->qty_pesan }}</td>
                                    <td> <input name="sub_total[]" class="form-control" type="hidden"
                                            value="{{ $temp->sub_total }}" readonly>{{ number_format($temp->sub_total) }}
                                    </td>
                                    <td align="center">
                                        <a href="/transaksi/hapus/{{ $temp->kd_mnu }}"
                                            onclick="return confirm('Yakin Ingin menghapus data?')"
                                            class="dnone d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                            <i class="fas fa-trash-alt fa-sm text-white-50"></i> Hapus</a>
                                    </td>
                                </tr>
                                @php($total += $temp->sub_total)
                            @endforeach
                            <tr align = "center">
                                <td colspan="3"></td>
                                <td><input name="total" class="form-control" type="hidden"
                                        value="{{ $total }}">Total {{ number_format($total) }}</a>
                                <td></td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <input type="submit" class="btn btn-primary btn-send" value="Simpan Pemesanan">
            </div>
        </div>
    </form>
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" ariahidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/sem/store" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Menu</label>
                            <select name="mnu" id="kd_mnu select2" class="form-control" required width="100%">
                                <option value="">Pilih</option>
                                @foreach ($menu as $product)
                                    <option value="{{ $product->kd_mnu }}">{{ $product->kd_mnu }} -
                                        {{ $product->nm_mnu }} - Rp {{ number_format($product->harga) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Jumlah</label>
                            <input type="number" min="1" name="qty" id="addnmmnu" class="form-control"
                                id="exampleFormControlInput1" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-primary btn-send" value="Tambah Barang">
                    </div>
            </div>
            </form>
        </div>
    </div>
@endsection
