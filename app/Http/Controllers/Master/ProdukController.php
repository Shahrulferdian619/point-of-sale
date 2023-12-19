<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Produk::with('kategori')->get();
        return view('page.master.produk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = KategoriProduk::all();
        return view('page.master.produk.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function converter($val){
        $rp = str_replace('Rp','', $val);
        $titik = str_replace('.','', $rp);
        return $titik;
    }

    private function converterPersen($val){
        $persen = str_replace('%','', $val);
        return $persen;
    }

    public function store(Request $request)
    {
        $produk = $request->input('produk');
        foreach ($produk as $key => $value) {
            $produk[$key]['harga_beli'] = $this->converter($value['harga_beli']);
            $produk[$key]['harga_jual'] = $this->converter($value['harga_jual']);
            $produk[$key]['diskon'] = $this->converterPersen($value['diskon']);
        }

        $request->merge([
            'produk'=>$produk
        ]);

        $request->validate([
            'produk.*.nama_produk'=>'required|unique:produk,nama_produk',
            'produk.*.kategori_id'=>'required',
            'produk.*.harga_beli'=>'required',
            'produk.*.harga_jual'=>'required',
            'produk.*.diskon'=>'required|numeric',
        ],[
            'produk.*.nama_produk.required'=>'Nama produk harus diisi.',
            'produk.*.nama_produk.unique'=>'Nama produk sudah ada.',
            'produk.*.kategori_id.required'=>'Kategori produk harus diisi.',
            'produk.*.harga_beli.required'=>'Harga beli harus diisi.',
            'produk.*.harga_jual.required'=>'Harga jual harus diisi.',
            'produk.*.diskon.required'=>'Diskon harus diisi.',
            'produk.*.diskon.numeric'=>'Diskon harus berupa angka.',
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->input('produk') as $value) {
                Produk::create([
                    'nama_produk'=>$value['nama_produk'],
                    'kategori_id'=>$value['kategori_id'],
                    'brand'=>$value['brand'],
                    'harga_beli'=>$value['harga_beli'],
                    'harga_jual'=>$value['harga_jual'],
                    'diskon'=>$value['diskon'],
                ]);
            }

            DB::commit();
            return back()->with('success', 'Produk berhasil dibuat.');
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
        $data = Produk::find($id);
        $kategori = KategoriProduk::all();
        return view('page.master.produk.edit', compact('data','kategori'));
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
        $request->merge([
            'harga_beli'=>$this->converter($request->input('harga_beli')),
            'harga_jual'=>$this->converter($request->input('harga_jual')),
            'diskon'=>$this->converterPersen($request->input('diskon')),
        ]);

        $request->validate([
            'nama_produk'=>'required|unique:produk,nama_produk,'.$id,
            'kategori_id'=>'required',
            'harga_beli'=>'required',
            'harga_jual'=>'required',
            'diskon'=>'required|numeric',
        ],[
            'nama_produk.required'=>'Nama produk harus diisi.',
            'nama_produk.unique'=>'Nama produk sudah ada.',
            'kategori_id.required'=>'Kategori produk harus diisi.',
            'harga_beli.required'=>'Harga beli harus diisi.',
            'harga_jual.required'=>'Harga jual harus diisi.',
            'diskon.required'=>'Diskon harus diisi.',
            'diskon.numeric'=>'Diskon harus berupa angka.',
        ]);

        // dd($request->all());

        try {
            DB::beginTransaction();

            $data = Produk::find($id);
            $data->update([
                'nama_produk'=>$request->nama_produk,
                'kategori_id'=>$request->kategori_id,
                'brand'=>$request->brand,
                'harga_beli'=>$request->harga_beli,
                'harga_jual'=>$request->harga_jual,
                'diskon'=>$request->diskon,
            ]);

            DB::commit();
            return back()->with('success', 'Produk '.$data->nama_produk.' berhasil diupdate.');
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
