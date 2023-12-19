<?php

namespace App\Service\Transaksi;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class PenjualanService{
    
    public function storeData($request){
        $data = $this->storeHeader($request);
        $this->storeRinci($request, $data);
        return $data;
    }

    public function storeHeader($request){
        DB::beginTransaction();
        try {
            $data = Penjualan::create([
                'nomer_pesanan'=>$request->nomer_pesanan,
                'tanggal'=>$request->tanggal,
                'metode_pembayaran'=>$request->metode_pembayaran,
                'keterangan'=>$request->keterangan,
                'grantotal'=>$request->grantotal,
                'nominal_bayar'=>$request->nominal_bayar,
                'nominal_kembalian'=>$request->nominal_kembalian,
            ]);

            DB::commit();
            return $data;
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan teknis '.$th->getMessage());
        }
    }

    public function storeRinci($request, $data){
        // dd($request->input('penjualan'));
        DB::beginTransaction();
        try {
            foreach ($request->input('penjualan') as $value) {
                // dd($value['produk_id']);
                $data->penjualanRinci()->create([
                    'produk_id'=>$value['produk_id'],
                    'qty'=>$value['qty'],
                    'harga_jual'=>$value['harga_jual'],
                    'diskon'=>$value['diskon'],
                    'subtotal'=>$value['subtotal'],
                ]);
    
                $produk = Produk::find($value['produk_id']);
                $produk->stok -= $value['qty'];
                $produk->save();
            }

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan teknis '.$th->getMessage());
        }
    }

}