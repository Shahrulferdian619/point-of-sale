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
                        <li class="breadcrumb-item">Master</li>
                        <li class="breadcrumb-item">Produk</li>
                        <li class="breadcrumb-item">Edit Produk</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('master.produk-update', $data->id) }}" method="post">
            @method('patch')
            @csrf
            <div class="card">
                <div class="card-body"> 
                    <table>
                        <tr>
                            <th style="width: 250px">Nama Produk</th>
                            <td style="width: 5%">:</td>
                            <td style="width: 60%"><input value="{{ $data->nama_produk }}" type="text" name="nama_produk" class="form-control" placeholder="harus diisi"></td>
                        </tr>
                    </table>
                    <table style="margin-top: 1%">
                        <tr>
                            <th style="width: 250px">Kategori</th>
                            <td style="width: 5%">:</td>
                            <td style="width: 60%">
                                <select name="kategori_id" id="" class="form-control">
                                    <option value="{{ $data->kategori_id }}">{{ $data->kategori->nama_kategori }}</option>
                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </table>
                    <table style="margin-top: 1%">
                        <tr>
                            <th style="width: 250px">Brand</th>
                            <td style="width: 5%">:</td>
                            <td style="width: 60%"><input value="{{ $data->brand }}" type="text" name="brand" class="form-control" placeholder="opsional"></td>
                        </tr>
                    </table>
                    <table style="margin-top: 1%">
                        <tr>
                            <th style="width: 250px">Harga Beli</th>
                            <td style="width: 5%">:</td>
                            <td style="width: 60%"><input value="Rp{{ number_format($data->harga_beli, 0, ',', '.') }}" type="text" name="harga_beli" class="form-control harga-beli" placeholder="harus diisi"></td>
                        </tr>
                    </table>
                    <table style="margin-top: 1%">
                        <tr>
                            <th style="width: 250px">Harga Jual</th>
                            <td style="width: 5%">:</td>
                            <td style="width: 60%"><input type="text" name="harga_jual" class="form-control harga-jual" value="Rp{{ number_format($data->harga_jual, 0, ',', '.') }}" placeholder="harus diisi"></td>
                        </tr>
                    </table>
                    <table style="margin-top: 1%">
                        <tr>
                            <th style="width: 250px">Diskon</th>
                            <td style="width: 5%">:</td>
                            <td style="width: 60%"><input type="text" name="diskon" class="form-control" value="{{ $data->diskon }}%" placeholder="harus diisi"></td>
                        </tr>
                    </table>
                </div>
            </div>
    
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('master.produk-index') }}" class="btn btn-outline-danger" >Kembali</a>
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

@section('scr')
    <script>
        $(document).ready(function () {
            $('.harga-beli').on('input', function() {
                // Hapus karakter non-digit dari nilai input
                let rawValue = $(this).val().replace(/[^0-9]/g, '');

                // Ubah nilai menjadi format mata uang
                let formattedValue = formatCurrency(rawValue);

                // Setel nilai input yang diformat
                $(this).val(formattedValue);
            });

            $('.harga-jual').on('input', function() {
                // Hapus karakter non-digit dari nilai input
                let rawValue = $(this).val().replace(/[^0-9]/g, '');

                // Ubah nilai menjadi format mata uang
                let formattedValue = formatCurrency(rawValue);

                // Setel nilai input yang diformat
                $(this).val(formattedValue);
            });

            function formatCurrency(value) {
                // Ubah nilai menjadi format mata uang (Rp100.000)
                return 'Rp' + parseFloat(value).toLocaleString('id-ID');
            }
        });
    </script>
@endsection