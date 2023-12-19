@extends('template.index')

@section('container')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengeluaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Transaksi</li>
                        <li class="breadcrumb-item">Pengeluaran</li>
                        <li class="breadcrumb-item">Buat Pengeluaran</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('transaksi.pengeluaran-store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body"> 
                    <table>
                        <tr>
                            <th style="width: 250px">Nominal</th>
                            <td style="width: 5%">:</td>
                            <td style="width: 60%"><input type="text" value="Rp0" placeholder="harus diisi" name="nominal" class="form-control nominal"></td>
                        </tr>
                    </table>
                    <table style="margin-top: 3%">
                        <tr>
                            <th style="width: 250px">Keterangan</th>
                            <td style="width: 5%">:</td>
                            <td style="width: 60%">
                                <textarea name="keterangan" id="" cols="30" rows="5" class="form-control" placeholder="harus diisi"></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
    
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('transaksi.pengeluaran-index') }}" class="btn btn-outline-danger" >Kembali</a>
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

@section('scr')
    <script>
    $('.nominal').on('input', function() {
        let rawValue = $(this).val().replace(/[^0-9]/g, '');
        let formattedValue = formatCurrency(rawValue);
        $(this).val(formattedValue);
    });

    function formatCurrency(value) {
        return 'Rp' + parseFloat(value).toLocaleString('id-ID');
    }
    </script>
@endsection