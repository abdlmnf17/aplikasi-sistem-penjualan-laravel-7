<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        /* Tambahkan styling CSS sesuai kebutuhan */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Laporan Penjualan</h2>

    @if(isset($tanggal_awal) && isset($tanggal_akhir))
    <p>Periode: {{ $tanggal_awal }} sampai {{ $tanggal_akhir }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>No. Jual</th>
                <th>Tanggal Jual</th>
                <th>No. Faktur</th>
                <th>Total Jual</th>
                <th>No. Pesan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualans as $penjualan)
            <tr>
                <td>{{ $penjualan->no_jual }}</td>
                <td>{{ $penjualan->tgl_jual }}</td>
                <td>{{ $penjualan->no_faktur }}</td>
                <td>{{ $penjualan->total_jual }}</td>
                <td>{{ $penjualan->no_pesan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>



