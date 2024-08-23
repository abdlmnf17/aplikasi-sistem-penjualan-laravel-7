<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Nota Sate Maranggi Si Bungsu</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Courier New', Courier, monospace;
        }

        .invoice-box {
            max-width: 450px;
            margin: auto;
            padding: 25x;
            border: 10px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 15px;
            line-height: 1.6;
            color: #555;
        }

        .invoice-box pre {
            white-space: pre-wrap; /* Ensure text wraps */
            margin: 0;
            padding: 0;
        }

        .invoice-box table {
            width: 100%;
            line-height: 1.4;
            text-align: left;
            border-collapse: collapse; /* Ensures borders between cells merge */
        }

        .invoice-box table td {
            padding: 8px;
            vertical-align: top;
            font-family: 'Courier New', Courier, monospace; /* Ensures monospace font for table content */
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: center;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 24px;
            line-height: 36px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.heading td {
            background: #f3f3f3;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .invoice-box table tr.footer td {
            text-align: center;
            padding-top: 20px;
            font-style: italic;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td,
            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <pre><img src="asset/img/sate.png" width="200" alt="Logo"></pre>
                            </td>
                            <td>
                                <pre>No Pesanan: #{{ $noorder }}</pre>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <pre><strong>Nama Pelanggan:</strong></pre>
                                @foreach ($order as $pesan)
                                    @foreach ($pel as $pe)
                                        @if ($pesan->kd_pel == $pe->kd_pel)
                                            <pre>{{ $pe->nm_pel }}</pre>
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td>
                                <pre><strong>Metode Pembayaran:</strong></pre>
                                @foreach ($detailpesan as $m)
                                    <pre>{{ $m->metode_pembayaran }}</pre>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td><pre>Produk</pre></td>
                <td><pre>Subtotal</pre></td>
            </tr>

            @php
            $total_sub_total = 0;
            foreach ($detail as $row) {
                $total_sub_total += $row->sub_total;
            }
            $pajak = $total_sub_total * 0.10;
        @endphp


            @foreach ($detail as $row)
                <tr class="item">
                    <td>
                        <pre>{{ $row->nm_mnu }}<br>Harga: Rp {{ number_format($row->sub_total / $row->qty_pesan) }} x {{ $row->qty_pesan }}</pre>
                    </td>
                    <td><pre>Rp {{ number_format($row->sub_total) }}</pre></td>
                </tr>
            @endforeach

            <tr class="pajak">
                <td><pre>Pajak (10%)</pre></td>
                <td><pre>Rp {{ number_format($pajak) }}</pre></td>
            </tr>

            <tr class="total">
                <td><pre>Total Akhir</pre></td>
                <td><pre>Rp {{ number_format($total_sub_total + $pajak) }}</pre></td>
            </tr>




            <tr class="footer">
                <td colspan="2"><pre>Terima kasih atas pembeliannya - have a nice day :)</pre></td>
            </tr>
        </table>
    </div>
</body>

</html>
