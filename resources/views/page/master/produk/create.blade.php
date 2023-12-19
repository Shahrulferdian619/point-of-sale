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
                        <li class="breadcrumb-item">Buat Produk</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('master.produk-store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Nama Produk</th>
                                <th>Brand</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Diskon</th>
                                <th style="color: rgb(0, 0, 255)" class="plus">
                                    <i class="fas fa-plus-square" style="font-size: 120%"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="body">
                            <tr class="tr-0">
                                <td>
                                    <select name="produk[0][kategori_id]" id="" class="form-control" style="width: 117%">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($data as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="produk[0][nama_produk]" placeholder="wajib diisi" style="width: 112%">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="produk[0][brand]" placeholder="opsional" style="width: 112%">
                                </td>
                                <td>
                                    <input type="text" class="form-control harga-beli" name="produk[0][harga_beli]" value="Rp0" style="width: 112%">
                                </td>
                                <td>
                                    <input type="text" class="form-control harga-jual" name="produk[0][harga_jual]" value="Rp0" style="width: 112%">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="produk[0][diskon]" value="0%" style="width: 100%">
                                </td>
                                <td>
                                    <i style="font-size: 120%; color: red; margin-top: 10px;" class="fas fa-trash remove"></i>
                                </td>
                            </tr>                         
                        </tbody>
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
        $(document).ready(function () {
            let rowBody = $('.body')[0].rows.length
            const body = $('.body')
            btn()

            $('.plus').on('click', function(){
                let tr = `
                    <tr class="tr-${rowBody}">
                        <td>
                            <select name="produk[${rowBody}][kategori_id]" id="" class="form-control" style="width: 117%">
                                <option value="">Pilih Kategori</option>
                                @foreach ($data as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="produk[${rowBody}][nama_produk]" placeholder="wajib diisi" style="width: 112%">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="produk[${rowBody}][brand]" placeholder="opsional" style="width: 112%">
                        </td>
                        <td>
                            <input type="text" class="form-control harga-beli" name="produk[${rowBody}][harga_beli]" value="Rp0" style="width: 112%">
                        </td>
                        <td>
                            <input type="text" class="form-control harga-jual" name="produk[${rowBody}][harga_jual]" value="Rp0" style="width: 112%">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="produk[${rowBody}][diskon]" value="0%" style="width: 100%">
                        </td>
                        <td>
                            <i style="font-size: 120%; color: red; margin-top: 10px;" class="fas fa-trash remove"></i>
                        </td>
                    </tr>
                `

                rowBody++
                body.append(tr);
                btn()
            })

            $(document).on('click', '.remove', function () {
                $(this).closest('tr').remove()
                btn()
            });

            $('body').on('input', '.harga-beli', function() {
                let rawValue = $(this).val().replace(/[^0-9]/g, '');
                let formattedValue = formatCurrency(rawValue);
                $(this).val(formattedValue);
            });
            
            $('body').on('input', '.harga-jual', function() {
                let rawValue = $(this).val().replace(/[^0-9]/g, '');
                let formattedValue = formatCurrency(rawValue);
                $(this).val(formattedValue);
            });

            function formatCurrency(value) {
                // Ubah nilai menjadi format mata uang (Rp100.000)
                return 'Rp' + parseFloat(value).toLocaleString('id-ID');
            }

            function btn(){
                if ($('.body')[0].rows.length == 1) {
                    $('.remove')[0].disabled = true
                } else {
                    $('.remove')[0].disabled = false
                }
            }
        });
    </script>
@endsection