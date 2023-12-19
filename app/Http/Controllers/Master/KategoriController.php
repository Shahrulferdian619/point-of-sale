<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = KategoriProduk::all();
        return view('page.master.kategori.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.master.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori.*.nama_kategori'=>'required|unique:kategori,nama_kategori',
        ],[
            'kategori.*.nama_kategori.required'=>'Nama kategori harus diisi.',
            'kategori.*.nama_kategori.unique'=>'Nama kategori sudah ada.',
        ]); 

        try {
            DB::beginTransaction();

            foreach($request->input('kategori') as $value){
                KategoriProduk::create([
                    'nama_kategori'=>$value['nama_kategori'],
                    'keterangan'=>$value['keterangan'],
                ]);
            }

            DB::commit();
            return back()->with('success', 'Supplier berhasil dibuat.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan teknis '.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = KategoriProduk::find($id);
        return view('page.master.kategori.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori'=>'required|unique:kategori,nama_kategori,'.$id,
        ],[
            'nama_kategori.required'=>'Nama kategori harus diisi.',
            'nama_kategori.unique'=>'Nama kategori sudah ada.',
        ]);

        try {
            DB::beginTransaction();

            $data = KategoriProduk::find($id);
            $data->update([
                'nama_kategori'=>$request->nama_kategori,
                'keterangan'=>$request->keterangan
            ]);

            DB::commit();
            return back()->with('success', 'Kategori berhasil diupdate.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan teknis '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
