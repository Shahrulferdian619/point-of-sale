@extends('template.index')

@section('container')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penjualan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Transaksi</li>
                        <li class="breadcrumb-item active">Penjualan</li>
                        <li class="breadcrumb-item active">Buat Penjualan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('transaksi.penjualan-store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th style="width: 10%">Qty</th>
                                        <th style="width: 25%">Harga</th>
                                        <th style="width: 10%">diskon</th>
                                        <th style="width: 25%">Subtotal</th>
                                        <th style="color: rgb(0, 0, 255); width: 5%" class="plus">
                                            <i class="fas fa-plus-square" style="font-size: 120%"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="body">
                                    <tr class="tr-0">
                                        <td>
                                            <select name="penjualan[0][produk_id]" class="form-control select-produk" id="" style="width: 110%">
                                                <option value="">Pilih Produk</option>
                                                @foreach ($dataPro as $dp)
                                                    <option data-diskon="{{ $dp->diskon }}" data-price="{{ $dp->harga_jual }}" value="{{ $dp->id }}">{{ $dp->nama_produk }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input style="width: 130%" type="number" value="0" class="form-control qty" name="penjualan[0][qty]">
                                        </td>
                                        <td style="">
                                            <input style="width: 110%" type="text" value="Rp0" class="form-control harga-jual" name="penjualan[0][harga_jual]" readonly>
                                        </td>
                                        <td style="">
                                            <input style="width: 120%" type="text" value="0" class="form-control diskon" name="penjualan[0][diskon]" readonly>
                                        </td>
                                        <td style="">
                                            <input style="text-align: right; width: 105%" type="text" value="Rp0" class="form-control subtotal" readonly name="penjualan[0][subtotal]">
                                        </td>
                                        <td>
                                            <i style="font-size: 120%; color: red; margin-top: 10px;" class="fas fa-trash remove"></i>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th style="text-align: right">Grantotal</th>
                                        <th style="text-align: right;">
                                            <input style="text-align: right; width: 105%" type="text" class="form-control grantotal" readonly name="grantotal" value="Rp0">
                                        </th>
                                        <th></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>      
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Nomer Pesanan</label>
                                    <input type="text" placeholder="harus diisi" class="form-control" name="nomer_pesanan">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Tanggal</label>
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="tanggal">
                                </div>
                            </div>

                            <label for="">Keterangan</label>
                            <textarea name="keterangan" placeholder="opsional" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <label for="">Metode Pembayaran</label>
                            <select name="metode_pembayaran" id="" class="form-control">
                                <option value="1" selected>Cash</option>
                                <option value="2">Lainnya</option>
                            </select>

                            <div class="row" style="margin-top: 4%;">
                                <div class="col-md-6">
                                    <label for="">Nominal Bayar</label>
                                    <input type="text" class="form-control bayar" name="nominal_bayar" placeholder="Input nominal">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Grantotal</label>
                                    <input type="text" class="form-control grantotal" value="Rp0" readonly>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 4%">
                                <div class="col-md-6" style="text-align: right">
                                    <label for="">Kembalian</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control kembalian" readonly name="nominal_kembalian" value="Rp0">
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="card">
                        <div class="card-body">
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
                    <tr class="tr-0">
                        <td>
                            <select name="penjualan[${rowBody}][produk_id]" class="form-control select-produk" id="" style="width: 110%">
                                <option value="">Pilih Produk</option>
                                @foreach ($dataPro as $dp)
                                    <option data-diskon="{{ $dp->diskon }}" data-price="{{ $dp->harga_jual }}" value="{{ $dp->id }}">{{ $dp->nama_produk }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input style="width: 130%" type="number" value="0" class="form-control qty" name="penjualan[${rowBody}][qty]">
                        </td>
                        <td style="">
                            <input style="width: 110%" type="text" value="Rp0" class="form-control harga-jual" name="penjualan[${rowBody}][harga_jual]" readonly>
                        </td>
                        <td style="">
                            <input style="width: 120%" type="text" value="" class="form-control diskon" name="penjualan[${rowBody}][diskon]" readonly>
                        </td>
                        <td style="">
                            <input style="text-align: right; width: 105%" type="text" value="Rp0" class="form-control subtotal" readonly name="penjualan[${rowBody}][subtotal]">
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
            
            $('body').on('input', '.harga-jual', function() {
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

            function convertNilaiKeTanpaFormat(nilaiDenganFormat) {
                let nilaiTanpaFormat = nilaiDenganFormat.replace(/[^\d,]/g, '');
                nilaiTanpaFormat = nilaiTanpaFormat.replace(/,/g, '');
                return nilaiTanpaFormat;
            }

            $(document).on('input', '.qty', function () {
                subtotal();
            });
            
            $(document).on('input', '.bayar', function () {
                let rawValue = $(this).val().replace(/[^0-9]/g, '');
                let formattedValue = formatCurrency(rawValue);
                $(this).val(formattedValue);
                subtotal()
            });

            function subtotal() {
                let grantotal = 0;
                body.find('tr').each(function () {
                    const row = $(this);
                    let hargaRaw = row.find('.harga-jual').val();
                    let harga = convertNilaiKeTanpaFormat(hargaRaw);
                    let diskonRaw = row.find('.diskon').val();
                    let diskon = parseFloat(diskonRaw) / 100 * harga;
                    let qty = parseFloat(row.find('.qty').val()) || 0; 

                    let subtotal = (harga - diskon) * qty;

                    grantotal += subtotal;

                    row.find('.subtotal').val(formatCurrency(subtotal));
                });

                let bayarRaw = $('.bayar').val()
                let bayar = convertNilaiKeTanpaFormat(bayarRaw)
                hasil = bayar - grantotal
                $('.kembalian').val(formatCurrency(hasil))

                $('.grantotal').val(formatCurrency(grantotal));
            }

            $(document).on('change', '.select-produk', function () {
                const tr = $(this).parent().parent();
                let harga = parseFloat(tr.find('.select-produk option:selected').data('price')) || 0; 
                let diskon = parseFloat(tr.find('.select-produk option:selected').data('diskon')) || 0; 
                tr.find('.harga-jual').val(formatCurrency(harga));
                tr.find('.diskon').val(diskon + '%');
            });
        });
    </script>
@endsection