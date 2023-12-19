<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kwitansi Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="background: rgb(170, 170, 170)">
    <center>
        Toko Sirul
    </center>
    <center style="margin-top: -3%">
        Sidoarjo 5 / 123456789
    </center>

    <center style="top: 3%">
        Toko Sirul
    </center>
    <center style="margin-top: -3%">
        Nomer Pembelian : {{ $penjualan->nomer_pesanan }}
    </center>
    <center style="margin-top: -3%">
        Jl. Nganjuk Doli
    </center>
    <center style="margin-top: -2%">================================</center>

    <center style="top: 3%">
        Toko Sirul
    </center>
    <center style="margin-top: -3%">
        {{ date('Y/m/d', strtotime($penjualan->tanggal)) }}
    </center>

    <table style="margin-top: 3%; margin-left: 3%; width: 80%; font-size: 80%">
        <tr>
            <th>ID TRANSAKSI</th>
            <th>:</th>
            <td>{{ $penjualan->id }}</td>
        </tr>
        <tr>
            <th>NOMER PEMBELIAN</th>
            <th>:</th>
            <td>{{ $penjualan->nomer_pesanan }}</td>
        </tr>
        <tr>
            <th>TAGIHAN</th>
            <th>:</th>
            <td>Rp{{ number_format($penjualan->grantotal, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>METODE PEMBAYARAN</th>
            <th>:</th>
            <td>
                @if ($penjualan->metode_pembayaran == 1)
                    Cash
                @else
                    Lainnya
                @endif
            </td>
        </tr>
    </table>

    <center style="margin-top: 3%; font-size: 80%">---DETAIL PEMBELIAN---</center>
    @foreach ($penjualanRinci as $key => $niggas)
        <table style="margin-top: 3%; margin-left: 3%; width: 60%; font-size: 80%">
            <tr>
                <th>PRODUK {{ $loop->iteration }}</th>
                <th>:</th>
                <td>{{ $niggas->produk->nama_produk }}</td>
            </tr>
            <tr>
                <th>HARGA</th>
                <th>:</th>
                <td>Rp{{ number_format($niggas->harga_jual, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>QTY</th>
                <th>:</th>
                <td>{{ $niggas->qty }}</td>
            </tr>
            <tr>
                <th>DISKON</th>
                <th>:</th>
                <td>{{ $niggas->diskon }}</td>
            </tr>
            <tr>
                <th>SUBTOTAL</th>
                <th>:</th>
                <td>Rp{{ number_format($niggas->harga_jual, 0, ',', '.') }}</td>
            </tr>
        </table>
        <center>-------------------------------</center>
    @endforeach
</body>
</html>