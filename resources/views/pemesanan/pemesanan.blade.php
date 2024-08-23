@extends('layouts.layout')

@section('content')
    @include('sweetalert::alert')

    @php
        function formatMenuName($string)
        {
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
                                            <input type="text" name="no_pesan" value="{{ $formatnya }}"
                                                class="form-control" id="no_pesan" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="tgl">Tanggal Transaksi</label>
                                            <input type="date" name="tgl" id="tgl" class="form-control"
                                                required>
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
                                            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control"
                                                required>
                                                <option value="">Pilih Metode Pembayaran</option>
                                                @foreach ($metodePembayaran as $metode)
                                                    <option value="{{ $metode->nama }}">{{ $metode->nama }} -
                                                        {{ $metode->status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-header text-center">
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#exampleModalScrollable">
                                            <i class="fas fa-plus"></i> Tambah Menu
                                        </button>
                                        <button type="button" class="btn btn-info btn-sm"
                                            onclick="window.location.href='/pelanggan'">
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
                                                        <th>Sub Total (Rp.)</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $total = 0;
                                                        $pajak = 0;
                                                        $totalAkhir = 0;
                                                    @endphp

                                                    @foreach ($temp_pemesanan as $temp)
                                                        <tr class="text-center">
                                                            <td>
                                                                <input name="kd_mnu[]" type="hidden"
                                                                    value="{{ $temp->kd_mnu }}" readonly>
                                                                {{ $temp->kd_mnu }}
                                                            </td>
                                                            <td>
                                                                <input name="nm_mnu[]" type="hidden"
                                                                    value="{{ $temp->nm_mnu }}" readonly>
                                                                {!! formatMenuName($temp->nm_mnu) !!}
                                                            </td>
                                                            <td>
                                                                <input name="qty_pesan[]" type="hidden"
                                                                    value="{{ $temp->qty_pesan }}" readonly>
                                                                {{ $temp->qty_pesan }}
                                                            </td>
                                                            <td>
                                                                <input name="sub_total[]" type="hidden"
                                                                    value="{{ $temp->sub_total }}" readonly>
                                                               {{ number_format($temp->sub_total) }}
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm delete-btn"
                                                                    data-id="{{ $temp->kd_mnu }}">
                                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                                </button>
                                                            </td>
                                                        </tr>

                                                        @php
                                                            $total += $temp->sub_total;
                                                            $pajak = $total * 0.1; // Pajak 10%
                                                            $totalAkhir = $total + $pajak;
                                                        @endphp
                                                    @endforeach

                                                </tbody>
                                                <br />


                                            </table>
                                            <br>
                                            <div class="container mt-4">
                                                <div class="summary">
                                                    <div class="summary-item">
                                                        <span class="label">Total</span>
                                                        <span class="amount">

                                                            <input id="total" name="total" type="hidden"
                                                                value="{{ $total }}">
                                                            <span id="total-amount">{{ number_format($total) }}</span>
                                                        </span>
                                                    </div>
                                                    <div class="summary-item">
                                                        <span class="label">Pajak (10%)</span>
                                                        <span class="amount">

                                                            <input id="pajak" name="pajak" type="hidden"
                                                                value="{{ $pajak }}">
                                                            <span id="pajak-amount">{{ number_format($pajak) }}</span>
                                                        </span>
                                                    </div>
                                                    <div class="summary-item highlight">
                                                        <span class="label">Total Akhir</span>
                                                        <span class="amount">

                                                            <input id="total-akhir" name="total_akhir" type="hidden"
                                                                value="{{ $totalAkhir }}">
                                                            <span
                                                                id="total-akhir-amount">{{ number_format($totalAkhir) }}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><br />

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
                    <form id="add-menu-form" action="/sem/store" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="mnu">Menu</label>
                                <select name="mnu" id="mnu" class="form-control" required>
                                    <option value="">Pilih</option>
                                    @foreach ($menu as $product)
                                        <option value="{{ $product->kd_mnu }}">
                                            {{ $product->kd_mnu }} - {{ $product->nm_mnu }} - Rp
                                            {{ number_format($product->harga) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="qty">Jumlah</label>
                                <input type="number" min="1" name="qty" id="qty" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-info">Tambah</button>
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
                overflow-x: auto;
                /* Ensure table can scroll horizontally on small screens */
            }

            .table th,
            .table td {
                white-space: nowrap;
                /* Prevent text wrapping inside table cells */
                font-size: 0.9rem;
                /* Adjust font size for smaller screens */
            }
        }
    </style>


<script>
    $(document).ready(function() {
        // Event delegation untuk tombol hapus
        $('#dataTable').on('click', '.delete-btn', function() {
            var id = $(this).data('id'); // Ambil ID dari atribut data-id
            var row = $(this).closest('tr'); // Ambil baris tabel terdekat

            // Konfirmasi sebelum menghapus
            if (confirm('Yakin ingin menghapus data?')) {
                $.ajax({
                    url: '/transaksi/hapus/' + id, // URL hapus item
                    type: 'DELETE', // Gunakan metode DELETE
                    data: {
                        _token: '{{ csrf_token() }}' // Sertakan token CSRF
                    },
                    success: function(response) {
                        if (response.success) {
                            // Hapus baris tabel dari DOM jika sukses
                            row.remove();
                            alert(response.message);

                            // Update total values
                            updateTotals();

                            // Refresh halaman setelah 1 detik
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        // Menampilkan pesan kesalahan jika terjadi error
                        alert('Terjadi kesalahan saat menghapus data.');
                    }
                });
            }
        });

        // Handler untuk form tambah menu
        $('#add-menu-form').submit(function(e) {
            e.preventDefault(); // Mencegah refresh halaman

            var formData = $(this).serialize(); // Mengambil data form

            $.ajax({
                url: $(this).attr('action'), // URL form
                type: 'POST', // Metode POST
                data: formData,
                success: function(response) {
                    if (response.success) {
                        var existingRow = $(
                            `#dataTable tbody tr:has(button[data-id="${response.data.kd_mnu}"])`
                        );

                        if (existingRow.length > 0) {
                            // Update baris yang sudah ada
                            existingRow.find('td:nth-child(2)').text(response.data.nm_mnu);
                            existingRow.find('td:nth-child(3)').text(response.data.qty_pesan);
                            existingRow.find('td:nth-child(4)').text(formatCurrency(response.data.sub_total, false));
                        } else {
                            // Tambahkan baris baru ke tabel
                            var newRow = `<tr class="text-center">
                                <td>${response.data.kd_mnu}</td>
                                <td>${response.data.nm_mnu}</td>
                                <td>${response.data.qty_pesan}</td>
                                <td>${formatCurrency(response.data.sub_total, false)}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="${response.data.kd_mnu}">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </td>
                            </tr>`;
                            $('#dataTable tbody').append(newRow);
                        }

                        // Update total values
                        updateTotals();

                        // Tutup modal dan reset form
                        $('#exampleModalScrollable').modal('hide');
                        $('#add-menu-form')[0].reset();

                        // Refresh halaman setelah 1 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat menambahkan menu.');
                }
            });
        });

        function updateTotals() {
            var total = 0;
            var subtotalElems = $('td:nth-child(4)'); // Selektor untuk subtotal

            subtotalElems.each(function() {
                // Ambil teks, hilangkan karakter non-numerik lainnya
                var text = $(this).text().replace(/[^\d]/g, ''); // Hanya ambil angka
                var value = parseFloat(text) || 0; // Konversi ke angka
                total += value; // Tambahkan ke total
            });

            var pajak = total * 0.1; // Pajak 10%
            var totalAkhir = total + pajak;

            // Update UI dengan format mata uang
            $('#total').val(total);
            $('#total-amount').text(formatCurrency(total, true));
            $('#pajak').val(pajak);
            $('#pajak-amount').text(formatCurrency(pajak, true));
            $('#total-akhir').val(totalAkhir);
            $('#total-akhir-amount').text(formatCurrency(totalAkhir, true));
        }

        function formatCurrency(amount, withSymbol) {
            // Format angka sebagai mata uang IDR (Indonesia Rupiah)
            var formatted = amount.toLocaleString('id-ID', {
                style: 'decimal'
            });
            return withSymbol ? 'Rp ' + formatted : formatted; // Tambahkan simbol "Rp" jika diinginkan
        }

        // Pastikan updateTotals dipanggil setelah dokumen siap
        updateTotals();
    });
    </script>

@endsection
