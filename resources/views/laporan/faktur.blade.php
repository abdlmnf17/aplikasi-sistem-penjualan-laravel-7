<html>

<head>
    <meta charset="utf-8">
    <title>Nota Sate Maranggi Si Bungsu </title>
    <style>
        .invoice-box {
            max-width: 400px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 15px;
            line-height: 20px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: normal;
            /* inherit */
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: center;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 10px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 30px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
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

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sansserif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
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
                                <img src="asset/img/sate.png" width="200px">

                            <td>
                                No pesanan : <strong>#{{ $noorder }}</strong><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <td>
                            @foreach ($order as $pesan)
                                @foreach ($pel as $pe)
                                    @if ($pesan->kd_pel == $pe->kd_pel)
                                        <br>{{ $pe->nm_pel }}<br>
                        </td>
                        @endif
                        @endforeach
                        @endforeach
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Produk</td>
                <td>Subtotal</td>
            </tr>
            @php($total = 0)
            @foreach ($detail as $row)
                <tr class="item">
                    <td>
                        {{ $row->nm_mnu }}<br>
                        <strong>Harga</strong>: Rp {{ number_format($row->sub_total / $row->qty_pesan) }} x
                        {{ $row->qty_pesan }}
                    </td>
                    <td>Rp {{ number_format($row->sub_total) }}</td>
                </tr>
                @php($total += $row->sub_total)
            @endforeach
            <tr class="total">
                <td></td>
                <td>
                    Total: Rp {{ number_format($total) }}
                </td>
            </tr>
            <tr>
                <td colspan="3">Semoga Datang Kembali</td>
            </tr>
        </table>
    </div>
</body>

</html>
