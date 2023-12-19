@extends('template.index')

@section('container')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pembelian</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Transaksi</li>
                        <li class="breadcrumb-item active">Pembelian</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nomer Pembelian</th>
                            <th>Tanggal</th>
                            <th>Keterangan Produk</th>
                            <th>Grantotal</th>
                            <th style="color: rgb(0, 0, 255)">
                                <a href="{{ route('transaksi.pembelian-create') }}"><i class="fas fa-plus-square"></i> Buat</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $beli)
                            <tr>
                                <td>
                                    <a href="{{ route('transaksi.pembelian-edit', $beli->id) }}">{{ $beli->nomer_pembelian }}</a>
                                </td>
                                <td>{{ date('Y/m/d', strtotime($beli->tanggal)) }}</td>
                                <td class="produk">
                                    @foreach ($beli->pembelianRinci as $item)
                                        {{ $item->produk->nama_produk }}, 
                                    @endforeach
                                </td>
                                <td>Rp{{ number_format($beli->grantotal, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@section('scr')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "ordering": false,
                "responsive": true,
            })

            $('.produk').each(function(){
                let text = $(this).text()

                text = text.replace(/\s*\,\s*$/, '');
                $(this).text(text);
            })
        });
    </script>
@endsection