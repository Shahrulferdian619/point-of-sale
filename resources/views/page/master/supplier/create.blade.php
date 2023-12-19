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
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">Supplier</li>
                        <li class="breadcrumb-item active">Buat Supplier</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('master.supplier-store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Supplier</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th style="color: rgb(0, 0, 255)" class="plus">
                                    <i class="fas fa-plus-square" style="font-size: 120%"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="body">
                            <tr class="tr-0">
                                <td>
                                    <input type="text" class="form-control" name="supplier[0][nama_supplier]" style="width: 105%" placeholder="wajib diisi">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="supplier[0][alamat]" placeholder="wajib diisi" style="width: 105%">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="supplier[0][telepon]" placeholder="wajib diisi">
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
                            <input type="text" class="form-control" name="supplier[${rowBody}][nama_supplier]" style="width: 105%" placeholder="wajib diisi">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="supplier[${rowBody}][alamat]" style="width: 105%" placeholder="wajib diisi">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="supplier[${rowBody}][telepon]" style="width: 105%" placeholder="wajib diisi">
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