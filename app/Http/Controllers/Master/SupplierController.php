<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Supplier::all();
        return view('page.master.supplier.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.master.supplier.create');
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
            'supplier.*.nama_supplier'=>'required|unique:supplier,nama_supplier',
            'supplier.*.alamat'=>'required',
            'supplier.*.telepon'=>'required|numeric',
        ],[
            'supplier.*.nama_supplier.required'=>'Nama supplier harus diisi.',
            'supplier.*.nama_supplier.unique'=>'Nama supplier sudah ada.',
            'supplier.*.alamat.required'=>'Alamat harus diisi.',
            'supplier.*.telepon.required'=>'Telepon harus diisi.',
            'supplier.*.telepon.numeric'=>'Telepon harus diisi berupa angka.',
        ]); 

        try {
            DB::beginTransaction();

            foreach($request->input('supplier') as $value){
                Supplier::create([
                    'nama_supplier'=>$value['nama_supplier'],
                    'alamat'=>$value['alamat'],
                    'telepon'=>$value['telepon'],
                ]);
            }

            DB::commit();
            return back()->with('success', 'Supplier berhasil dibuat.');
        } catch (\Throwable $th) {
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Supplier::find($id);
        return view('page.master.supplier.edit', compact('data'));
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
            'supplier.*.nama_supplier'=>'required|unique:supplier,nama_supplier,'.$id,
            'supplier.*.alamat'=>'required',
            'supplier.*.telepon'=>'required|numeric',
        ],[
            'supplier.*.nama_supplier.required'=>'Nama supplier harus diisi.',
            'supplier.*.nama_supplier.unique'=>'Nama supplier sudah ada.',
            'supplier.*.alamat.required'=>'Alamat harus diisi.',
            'supplier.*.telepon.required'=>'Telepon harus diisi.',
            'supplier.*.telepon.numeric'=>'Telepon harus diisi berupa angka.',
        ]); 

        try {
            DB::beginTransaction();

            $data = Supplier::find($id);
            $data->update([
                'nama_supplier'=>$request->nama_supplier,
                'alamat'=>$request->alamat,
                'telepon'=>$request->telepon,
            ]);

            DB::commit();
            return back()->with('success', 'Supplier '.$data->nama_supplier.' berhasil diupdate.');
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
