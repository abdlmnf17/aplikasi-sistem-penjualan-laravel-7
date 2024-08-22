@extends('layouts.layout')

@section('content')
    @include('sweetalert::alert')

    @php
    function formatMenuName($string) {
    // Cari angka dalam string
    if (preg_match('/(\d+)$/', $string, $matches)) {
        $price = $matches[1];
        $name = preg_replace('/\d+$/', '', $string);
        return $name . ' (' . number_format($price) . ')';
    }
    return $string; // Jika tidak ada angka, kembalikan string apa adanya
}

    @endphp
    <div class="container mt-4">
        <!-- Page Heading -->
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">Transaksi Pemesanan</h1>
            </div>
        </div>

        <hr>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-14 col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="/detail/simpan" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="no_pesan">No Faktur</label>
                                            <input type="text" name="no_pesan" value="{{ $formatnya }}" class="form-control" id="no_pesan" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="tgl">Tanggal Transaksi</label>
                                            <input type="date" name="tgl" id="tgl" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="kd_pel">Pelanggan</label>
                                            <select name="kd_pel" id="kd_pel" class="form-control" required>
                                                <option value="">Pilih</option>
                                                @foreach ($pelanggan as $pel)
                                                    <option value="{{ $pel->kd_pel }}">{{ $pel->nm_pel }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="metode_pembayaran">Metode Pembayaran</label>
                                            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                                                <option value="">Pilih Metode Pembayaran</option>
                                                @foreach ($metodePembayaran as $metode)
                                                    <option value="{{ $metode->nama }}">{{ $metode->nama }} - {{$metode->status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-header text-center">
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModalScrollable">
                                            <i class="fas fa-plus"></i> Tambah Menu
                                        </button>
                                        <button type="button" class="btn btn-info btn-sm" onclick="window.location.href='/pelanggan'">
                                            <i class="fas fa-plus"></i> Tambah Pelanggan
                                        </button>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable">
                                                <thead class="thead-light">
                                                    <tr class="text-center">
                                                        <th>Kode</th>
                                                        <th>Nama</th>
                                                        <th>Jumlah</th>
                                                        <th>Sub Total</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php($total = 0)
                                                    @foreach ($temp_pemesanan as $temp)
                                                        <tr class="text-center">
                                                            <td>
                                                                <input name="kd_mnu[]" type="hidden" value="{{ $temp->kd_mnu }}" readonly>
                                                                {{ $temp->kd_mnu }}
                                                            </td>
                                                            <td>
                                                                <input name="nm_mnu[]" type="hidden" value="{{ $temp->nm_mnu }}" readonly>
                                                                {!! formatMenuName($temp->nm_mnu) !!}
                                                            </td>
                                                            <td>
                                                                <input name="qty_pesan[]" type="hidden" value="{{ $temp->qty_pesan }}" readonly>
                                                                {{ $temp->qty_pesan }}
                                                            </td>
                                                            <td>
                                                                Rp,<input name="sub_total[]" type="hidden" value="{{ $temp->sub_total }}" readonly>
                                                                {{ number_format($temp->sub_total) }}
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="/transaksi/hapus/{{ $temp->kd_mnu }}" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @php($total += $temp->sub_total)
                                                    @endforeach
                                                    <tr class="text-center">
                                                        <td colspan="3" style="font-size: 1.5rem;">Total</td>
                                                        <td style="font-size: 1.5rem;">
                                                            Rp.
                                                            <input name="total" type="hidden" value="{{ $total }}">
                                                            {{ number_format($total) }}
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-info">Simpan Pemesanan</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
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
                                <label for="mnu">Menu</label>
                                <select name="mnu" id="mnu" class="form-control" required>
                                    <option value="">Pilih</option>
                                    @foreach ($menu as $product)
                                        <option value="{{ $product->kd_mnu }} ">{{ $product->kd_mnu }} - {{ $product->nm_mnu }} - Rp {{ number_format($product->harga) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="qty">Jumlah</label>
                                <input type="number" min="1" name="qty" id="qty" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambah Barang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional CSS for Responsiveness -->
    <style>
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto; /* Ensure table can scroll horizontally on small screens */
            }

            .table th, .table td {
                white-space: nowrap; /* Prevent text wrapping inside table cells */
                font-size: 0.9rem; /* Adjust font size for smaller screens */
            }
        }
    </style>
@endsection
