<?php

namespace App\Service\Transaksi;

use App\Models\Pembelian;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class PembelianService{
    
    public function storeData($request){
        $data = $this->createHeader($request);
        $this->createRinci($request, $data);   
        return $data;
    }

    public function createHeader($request){
        DB::beginTransaction();
        try {
            $data = Pembelian::create([
                'nomer_pembelian'=>$request->nomer_pembelian,
                'tanggal'=>$request->tanggal,
                'supplier_id'=>$request->supplier_id,
                'keterangan'=>$request->keterangan,
                'grantotal'=>$request->grantotal,
            ]);

            DB::commit();
            return $data;
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan teknis '.$th->getMessage());
        }
    }

    public function createRinci($request, $data){
        // dd($request->input('pembelian'));
        DB::beginTransaction();
        try {
            foreach ($request->input('pembelian') as $value) {
                $data->pembelianRinci()->create([
                    'produk_id'=>$value['produk_id'],
                    'harga_beli'=>$value['harga_beli'],
                    'qty'=>$value['qty'],
                    'subtotal'=>$value['subtotal'],
                ]);

                $produk = Produk::find($value['produk_id']);
                $produk->stok += $value['qty'];
                $produk->save();
            }
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan teknis '.$th->getMessage());
        }
    }

    public function updateData($request, $id){
        $data = $this->updateHeader($request, $id);

        $dataId = Pembelian::find($id);

        $this->updateRinci($request, $dataId);
        return $data;
    }
    
    public function updateHeader($request, $id){
        DB::beginTransaction();
        try {
            $data = Pembelian::find($id);
            $data->update([
                'nomer_pembelian'=>$request->nomer_pembelian,
                'tanggal'=>$request->tanggal,
                'supplier_id'=>$request->supplier_id,
                'keterangan'=>$request->keterangan,
                'grantotal'=>$request->grantotal,
            ]);

            DB::commit();
            return $data;
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan teknis '.$th->getMessage());
        }
    }
    
    public function updateRinci($request, $dataId){
        DB::beginTransaction();
        try {
            foreach ($dataId->pembelianRinci as $value) {
                $produk = Produk::find($value['produk_id']);
                $produk->stok -= $value['qty'];
                $produk->save();
            }

            $dataId->pembelianRinci()->delete();

            foreach ($request->input('pembelian') as $value) {
                $dataId->pembelianRinci()->create([
                    'produk_id'=>$value['produk_id'],
                    'harga_beli'=>$value['harga_beli'],
                    'qty'=>$value['qty'],
                    'subtotal'=>$value['subtotal'],
                ]);

                $produk = Produk::find($value['produk_id']);
                $produk->stok += $value['qty'];
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