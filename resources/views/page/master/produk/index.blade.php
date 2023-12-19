@extends('template.index')

@section('container')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">Produk</li>
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
                            <th>Nama Produk</th>
                            <th>Kategori Produk</th>
                            <th>Brand</th>
                            <th>Stok</th>
                            <th>Harga Jual</th>
                            <th style="color: rgb(0, 0, 255)">
                                <a href="{{ route('master.produk-create') }}"><i class="fas fa-plus-square"></i> Buat</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $produk)
                            <tr>
                                <td>
                                    <a href="{{ route('master.produk-edit', $produk->id) }}">{{ $produk->nama_produk }}</a>
                                </td>
                                <td>{{ $produk->kategori->nama_kategori }}</td>
                                <td>{{ $produk->brand }}</td>
                                <td>{{ $produk->stok }}</td>
                                <td>Rp{{ number_format($produk->harga_jual, 0, ',', '.') }}</td>
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
        });
    </script>
@endsection