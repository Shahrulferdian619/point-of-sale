<?php

namespace App\Http\Requests\Transaksi;

use Illuminate\Foundation\Http\FormRequest;

class PenjualanStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation(){
        $penjualan = $this->input('penjualan');
        foreach ($penjualan as $key => $value) {
            $penjualan[$key]['harga_jual'] = converter($value['harga_jual']); 
            $penjualan[$key]['diskon'] = converterDiskon($value['diskon']); 
            $penjualan[$key]['subtotal'] = converter($value['subtotal']);
        }

        $this->merge([
            'grantotal'=>converter($this->input('grantotal')),
            'nominal_bayar'=>converter($this->input('nominal_bayar')),
            'nominal_kembalian'=>converter($this->input('nominal_kembalian')),
            'penjualan'=>$penjualan
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nomer_pesanan'=>'required|unique:penjualan,nomer_pesanan',
            'tanggal'=>'required|date',
            'metode_pembayaran'=>'required',
            'keterangan'=>'nullable',
            'grantotal'=>'required',
            'nominal_bayar'=>'required|numeric',
            'nominal_kembalian'=>'required|numeric',

            'penjualan.*.produk_id'=>'required',
            'penjualan.*.harga_jual'=>'required|numeric',
            'penjualan.*.qty'=>'required',
            'penjualan.*.subtotal'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'nomer_pesanan.required' => 'Nomor pesanan harus diisi.',
            'nomer_pesanan.unique' => 'Nomor pesanan sudah digunakan, pilih nomor pesanan yang lain.',
            'tanggal.required' => 'Tanggal harus diisi.',
            'metode_pembayaran.required' => 'Metode pembayaran harus dipilih.',
            'keterangan.nullable' => 'Keterangan harus berupa null atau string.',
            'grantotal.required' => 'Total harga harus diisi.',
            'nominal_bayar.required' => 'Nominal pembayaran harus diisi.',
            'nominal_bayar.numeric' => 'Nominal pembayaran harus berupa angka.',
            'nominal_kembalian.required' => 'Nominal kembalian harus diisi.',
            'nominal_kembalian.numeric' => 'Nominal kembalian harus berupa angka.',

            'penjualan.*.produk_id.required' => 'Produk ID pada item penjualan harus diisi.',
            'penjualan.*.harga_jual.required' => 'Harga jual pada item penjualan harus diisi.',
            'penjualan.*.harga_jual.numeric' => 'Harga jual pada item penjualan harus berupa angka.',
            'penjualan.*.qty.required' => 'Kuantitas pada item penjualan harus diisi.',
            'penjualan.*.subtotal.required' => 'Subtotal pada item penjualan harus diisi.',
        ];
    }
}
