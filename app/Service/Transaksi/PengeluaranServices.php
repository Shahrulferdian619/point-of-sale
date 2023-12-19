<?php

namespace App\Service\Transaksi;

use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;

class PengeluaranServices {

    public function createData ($req){
        DB::beginTransaction();
        try {
            $data = Pengeluaran::create([
                'nominal'=>$req->nominal,
                'keterangan'=>$req->keterangan
            ]);

            DB::commit();
            return $data;
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan teknis '.$th->getMessage());
        }
    }

    public function updateData ($request, $id){

        DB::beginTransaction();
        try {
            $data = Pengeluaran::find($id)->update([
                'nominal'=>$request->nominal,
                'keterangan'=>$request->keterangan
            ]);

            DB::commit();
            return $data;
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan teknis '.$th->getMessage());
        }
    }
}