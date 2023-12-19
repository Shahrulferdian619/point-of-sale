<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaksi\PembelianStore;
use App\Http\Requests\Transaksi\PembelianUpdate;
use App\Models\Pembelian;
use App\Models\Produk;
use App\Models\Supplier;
use App\Service\Transaksi\PembelianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    protected $pembelian;

    public function __construct(PembelianService $pembelian)
    {
        $this->pembelian = $pembelian;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pembelian::with('pembelianRinci.produk')->orderBy('tanggal', 'desc')->get();
        // dd($data);
        return view('page.transaksi.pembelian.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataSup = Supplier::all();
        $dataPro = Produk::all();
        return view('page.transaksi.pembelian.create', compact('dataSup', 'dataPro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(PembelianStore $request)
    {
        // dd($request->all());
        $data = $this->pembelian->storeData($request);
        // dd($data);
        return back()->with('success', 'Pembelian berhasil dibuat dengan nomor '.$data->nomer_pembelian);
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
        $data = Pembelian::find($id);
        $dataSup = Supplier::all();
        $dataPro = Produk::all();
        return view('page.transaksi.pembelian.edit', compact('dataSup', 'dataPro', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PembelianUpdate $request, $id)
    {
        $data = $this->pembelian->updateData($request, $id);
        return back()->with('success', 'Pembelian nomer '.$data->nomer_pembelian.' berhasil diupdate.');
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
