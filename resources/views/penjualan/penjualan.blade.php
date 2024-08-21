@extends('layouts.layout')

@section('content')
    @include('sweetalert::alert')

    <div class="container">
        <!-- Page Heading -->
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">Transaksi Penjualan</h1>
            </div>
        </div>

        <!-- Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th width="15%">No Pemesanan</th>
                                <th>Tanggal Pesan</th>
                                <th width="30%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesanan as $pesan)
                                <tr class="text-center">
                                    <td>{{ $pesan->no_pesan }}</td>
                                    <td>{{ $pesan->tgl_pesan }}</td>
                                    <td>
                                        <a href="{{ url('/penjualan-jual/' . Crypt::encryptString($pesan->no_pesan)) }}"
                                            class="btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i> Bayar
                                        </a>
                                        <a href="{{ route('cetak.order_pdf', [Crypt::encryptString($pesan->no_pesan)]) }}"
                                            target="_blank" class="btn btn-sm btn-warning shadow-sm">
                                            <i class="fas fa-print fa-sm text-white-50"></i> Cetak Invoice
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
