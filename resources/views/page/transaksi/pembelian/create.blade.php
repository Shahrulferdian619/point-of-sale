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
                        <li class="breadcrumb-item active">Buat Pembelian</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('transaksi.pembelian-store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th style="width: 15%">Qty</th>
                                        <th style="width: 25%">Harga</th>
                                        <th style="width: 25%">Subtotal</th>
                                        <th style="color: rgb(0, 0, 255); width: 5%" class="plus">
                                            <i class="fas fa-plus-square" style="font-size: 120%"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="body">
                                    <tr class="tr-0">
                                        <td>
                                            <select name="pembelian[0][produk_id]" class="form-control" id="" style="width: 105%">
                                                <option value="">Pilih Produk</option>
                                                @foreach ($dataPro as $dp)
                                                    <option value="{{ $dp->id }}">{{ $dp->nama_produk }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input style="width: 110%" type="number" value="0" class="form-control qty" name="pembelian[0][qty]">
                                        </td>
                                        <td style="">
                                            <input style="width: 105%" type="text" value="Rp0" class="form-control harga-beli" name="pembelian[0][harga_beli]">
                                        </td>
                                        <td style="">
                                            <input style="text-align: right; width: 105%" type="text" value="Rp0" class="form-control subtotal" readonly name="pembelian[0][subtotal]">
                                        </td>
                                        <td>
                                            <i style="font-size: 120%; color: red; margin-top: 10px;" class="fas fa-trash remove"></i>
                                        </td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th style="text-align: right">Grantotal</th>
                                        <th style="text-align: right;">
                                            <input style="text-align: right; width: 105%" type="text" class="form-control grantotal" readonly name="grantotal" value="Rp0">
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Nomer Pembelian</label>
                                    <input type="text" placeholder="harus diisi" class="form-control" name="nomer_pembelian">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Tanggal</label>
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="tanggal">
                                </div>
                            </div>
                            <label for="">Supplier</label>
                            <select name="supplier_id" id="" class="form-control">
                                <option value="">Pilih Supplier</option>
                                @foreach ($dataSup as $ds)
                                    <option value="{{ $ds->id }}">{{ $ds->nama_supplier }}</option>
                                @endforeach
                            </select>
                            <label for="">Keterangan</label>
                            <textarea name="keterangan" placeholder="opsional" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
    
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('transaksi.pembelian-index') }}" class="btn btn-outline-danger">Kembali</a>
                            <button type="submit" class="btn btn-outline-primary" style="margin-left: 1%">Simpan</button>
                        </div>
                    </div>
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
                            <select name="pembelian[${rowBody}][produk_id]" class="form-control" id="" style="width: 105%">
                                <option value="">Pilih Produk</option>
                                @foreach ($dataPro as $dp)
                                    <option value="{{ $dp->id }}">{{ $dp->nama_produk }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input style="width: 110%" type="number" value="0" class="form-control qty" name="pembelian[${rowBody}][qty]">
                        </td>
                        <td style="">
                            <input style="width: 105%" type="text" value="Rp0" class="form-control harga-beli" name="pembelian[${rowBody}][harga_beli]">
                        </td>
                        <td style="text-align: right">
                            <input style="text-align: right; width: 105%" type="text" value="Rp0" class="form-control subtotal" readonly name="pembelian[${rowBody}][subtotal]">
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

            function formatCurrency(value) {
                return 'Rp' + parseFloat(value).toLocaleString('id-ID');
            }

            function btn(){
                if ($('.body')[0].rows.length == 1) {
                    $('.remove')[0].disabled = true
                } else {
                    $('.remove')[0].disabled = false
                }
            }

            $(document).on('input', '.qty', function(){
                subtotal()
            })

            $(document).on('input', '.harga-beli', function() {
                subtotal()
            });

            function convertNilaiKeTanpaFormat(nilaiDenganFormat) {
                let nilaiTanpaFormat = nilaiDenganFormat.replace(/[^\d,]/g, '');
                nilaiTanpaFormat = nilaiTanpaFormat.replace(/,/g, '');
                return nilaiTanpaFormat;
            }

            function subtotal (){
                let grantotal = 0;
                body.find('tr').each(function(){
                    const row = $(this)
                    let hargaRaw = row.find('.harga-beli').val()
                    let harga = convertNilaiKeTanpaFormat(hargaRaw)
                    let qty = row.find('.qty').val()
                    console.log(qty);

                    let subtotal = qty * harga

                    grantotal += subtotal

                    row.find('.subtotal').val(formatCurrency(subtotal))
                })

                $('.grantotal').val(formatCurrency(grantotal))
            }
        });
    </script>
@endsection