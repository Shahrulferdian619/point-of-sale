<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaksi\PengeluaranStoreRequest;
use App\Http\Requests\Transaksi\PengeluaranUpdate;
use App\Models\Pengeluaran;
use App\Service\Transaksi\PengeluaranServices;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    protected $psv;

    public function __construct(PengeluaranServices $psv)
    {
        $this->psv = $psv;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengeluaran::orderBy('created_at', 'desc')->get();
        return view('page.transaksi.pengeluaran.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.transaksi.pengeluaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengeluaranStoreRequest $request)
    {  
        // dd($request);
        $this->psv->createData($request);
        return back()->with('success', 'Pengeluaran berhasil dibuat.');
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
        $data = Pengeluaran::find($id);
        return view('page.transaksi.pengeluaran.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PengeluaranUpdate $request, $id)
    {
        $this->psv->updateData($request, $id);
        return back()->with('success', 'Pengeluaran berhasi diupdate');
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
