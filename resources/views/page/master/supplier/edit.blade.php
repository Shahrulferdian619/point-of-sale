@extends('template.index')

@section('container')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Supplier</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Master</li>
                        <li class="breadcrumb-item">Supplier</li>
                        <li class="breadcrumb-item">Edit Supplier</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('master.supplier-update', $data->id) }}" method="post">
            @method('patch')
            @csrf
            <div class="card">
                <div class="card-body"> 
                    <table>
                        <tr>
                            <th style="width: 250px">Nama Supplier</th>
                            <td style="width: 5%">:</td>
                            <td style="width: 60%"><input type="text" name="nama_supplier" class="form-control" value="{{ $data->nama_supplier }}"></td>
                        </tr>
                    </table>
                    <table style="margin-top: 1%">
                        <tr>
                            <th style="width: 250px">Alamat</th>
                            <td style="width: 5%">:</td>
                            <td style="width: 60%"><input type="text" name="alamat" class="form-control" value="{{ $data->alamat }}"></td>
                        </tr>
                    </table>
                    <table style="margin-top: 1%">
                        <tr>
                            <th style="width: 250px">Telepon</th>
                            <td style="width: 5%">:</td>
                            <td style="width: 60%"><input type="text" name="telepon" class="form-control" value="{{ $data->telepon }}"></td>
                        </tr>
                    </table>
                </div>
            </div>
    
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('master.supplier-index') }}" class="btn btn-outline-danger" >Kembali</a>
                    <button type="submit" class="btn btn-outline-primary" style="margin-left: 1%">Simpan</button>
                </div>
            </div>
        </form>
    </section>

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
                title: 'Berhasil Update!',
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