<!DOCTYPE html>
<html>

<head>
    <title>Laporan Jurnal Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 10pt;
        }
    </style>
</head>

<body>
    <table class="table table-bordered" width="100%" align="center">
        <tr align="center">
            <td>
                <h2>Laporan Jurnal Penjualan<br>Rumah Makan Sate Maranggi Si Bungsu</h2>
                <hr>
            </td>
        </tr>
    </table>
    <table class="table table-bordered" width="100%" align="center">
        <thead>
            <tr>
                <th width="5%">Tanggal Transaksi</th>
                <th width="15%">Nama Akun/Perkiraan</th>
                <th width="5%">Debet</th>
                <th width="5%">Kredit</th>
            </tr>
        </thead>
        <tbody>
            @php
                $subtotal1 = 0;
                $subtotal2 = 0;
            @endphp
            @foreach ($laporan as $akn)
                <!-- <tr><td colspan="5">{{ $akn->tgl_jurnal }}</td></tr> -->
                @foreach ($laporan as $bb)
                    <!-- pembuatan prulangan bersarang -->
                    @if ($loop->parent->first)
                        <tr>
                            <td>{{ $bb->tgl_jurnal }}</td>
                            <td>{{ $bb->no_jurnal }} {{ $bb->keterangan }}</td>
                            <td>{{ number_format($bb->debet) }}</td>
                            <td>{{ number_format($bb->kredit) }}</td>
                        </tr>
                        <!-- hitung total debet dan kredit -->
                        {{ $subtotal1 += $bb->debet }};
                        {{ $subtotal2 += $bb->kredit }};
                    @endif
                @endforeach
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td>Rp. {{ number_format($subtotal1) }}</td>
                <td>Rp. {{ number_format($subtotal2) }}</td>
            </tr>
        </tbody>
    </table>
    <div align="right">
        <h6>Tanda Tangan</h6><br><br>
        <h6>{{ Auth::user()->name }}</h6>
    </div>
</body>

</html>
