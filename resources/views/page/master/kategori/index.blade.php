@extends('template.index')

@section('container')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kategori Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">Kategori</li>
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
                            <th>Nama Kategori</th>
                            <th>Keterangan</th>
                            <th style="color: rgb(0, 0, 255)">
                                <a href="{{ route('master.kategori-create') }}"><i class="fas fa-plus-square"></i> Buat</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $kategori)
                            <tr>
                                <td>
                                    <a href="{{ route('master.kategori-edit', $kategori->id) }}" style="text-decoration: none">{{ $kategori->nama_kategori }}</a>
                                </td>
                                <td>{{ $kategori->keterangan }}</td>
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