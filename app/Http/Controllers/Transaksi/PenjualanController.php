<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaksi\PenjualanStore;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Service\Transaksi\PenjualanService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    protected $penjualan;
    public function __construct(PenjualanService $penjualan)
    {
        $this->penjualan = $penjualan;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataPro = Produk::all();
        return view('page.transaksi.penjualan.create', compact('dataPro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenjualanStore $request)
    {
        $data = $this->penjualan->storeData($request);
        return redirect()->route('transaksi.penjualan-show', $data->id)->with('success', 'Pembayaran berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Penjualan::find($id);
        return view('page.transaksi.penjualan.show', compact('data'));
    }

    public function dataPDF($id){
        $data = Penjualan::find($id);
        $dataRinci = $data->penjualanRinci()->get();
    
        // Mengembalikan data dan data rinci sebagai array
        return ['penjualan' => $data, 'penjualanRinci' => $dataRinci];
    }
    
    public function exportPDF($id)
    {
        $data = $this->dataPDF($id);
    
        // Mendapatkan data penjualan dan penjualan rinci dari hasil metode dataPDF
        $penjualan = $data['penjualan'];
        $penjualanRinci = $data['penjualanRinci'];
    
        $pdf = Pdf::loadView('page.transaksi.penjualan.pdf', compact('penjualan', 'penjualanRinci'));
        $pdf->setPaper('a6', 'portrait');
    
        return $pdf->stream();
    }    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
