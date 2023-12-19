@extends('template.index')

@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penjualan Detail</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Transaksi</li>
                        <li class="breadcrumb-item active">Penjualan</li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-striped">
                            <tr>
                                <th>Nomer Pesanan</th>
                                <th>:</th>
                                <td>{{ $data->nomer_pesanan }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <th>:</th>
                                <td>{{ date('Y/m/d', strtotime($data->tanggal)) }}</td>
                            </tr>
                            <tr>
                                <th>Metode Pembayaran</th>
                                <th>:</th>
                                <td>
                                    @if ($data->metode_pembayaran == 1)
                                        Cash
                                    @else
                                        Lainnya
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped">
                            <tr>
                                <th>Nominal Bayar</th>
                                <th>:</th>
                                <td>
                                    Rp{{ number_format($data->nominal_bayar, 0, ',', '.') }}
                                </td>
                            </tr>                        
                            <tr>
                                <th>Grantotal</th>
                                <th>:</th>
                                <td>
                                    Rp{{ number_format($data->grantotal, 0, ',', '.') }}
                                </td>
                            </tr>                        
                            <tr>
                                <th>Kembalian</th>
                                <th>:</th>
                                <td>
                                    Rp{{ number_format($data->nominal_kembalian, 0, ',', '.') }}
                                </td>
                            </tr>                        
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Diskon</th>
                            <th style="text-align: right">Subtotal</th>
                            <th style="text-align: center">
                                <a href="{{ route('transaksi.penjualan-pdf', $data->id) }}"><i class="far fa-file-alt"></i> Cetak Kuitansi</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->penjualanRinci as $my)
                            <tr>
                                <td>{{ $my->produk->nama_produk }}</td>
                                <td>{{ $my->qty }}</td>
                                <td>Rp{{ number_format($my->harga_jual, 0, ',', '.') }}</td>
                                <td>{{ $my->diskon }}%</td>
                                <td style="text-align: right">Rp{{ number_format($my->subtotal, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tbody>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th style="text-align: right">Grantotal</th>
                            <th style="text-align: right">Rp{{ number_format($data->grantotal, 0, ',', '.') }}</th>
                            <th></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- sweet alert --}}
    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ $errors->first() }}',
        });
    </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Input!',
                text: '{{ session('success') }}',
            });
        </script>
    @endif
    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Upps, terjadi kesalahan!',
            text: '{{ session('error') }}',
        });
    </script>
    @endif
@endsection