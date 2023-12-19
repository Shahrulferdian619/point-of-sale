<?php

namespace App\Http\Requests\Transaksi;

use Illuminate\Foundation\Http\FormRequest;

class PembelianStore extends FormRequest
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
        $pembelian = $this->input('pembelian');
        foreach ($pembelian as $key => $value) {
            $pembelian[$key]['harga_beli'] = converter($value['harga_beli']); 
            $pembelian[$key]['subtotal'] = converter($value['subtotal']);
        }

        $this->merge([
            'grantotal'=>converter($this->input('grantotal')),
            'pembelian'=>$pembelian
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
            'nomer_pembelian'=>'required|unique:pembelian,nomer_pembelian',
            'tanggal'=>'required',
            'supplier_id'=>'required',
            'keterangan'=>'nullable',
            'grantotal'=>'required',

            'pembelian.*.produk_id'=>'required',
            'pembelian.*.qty'=>'required',
            'pembelian.*.harga_beli'=>'required|numeric',
            'pembelian.*.subtotal'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'nomer_pembelian.required'=>'nomer pembelian harus diisi.',
            'nomer_pembelian.unique'=>'nomer pembelian sudah ada.',
            'supplier_id.required'=>'Supplier harus diisi.',
    
            'pembelian.*.harga_beli.required'=>'Harga beli harus diisi.',
            'pembelian.*.harga_beli.numeric'=>'Harga beli harus berupa angka.',
            'pembelian.*.qty.required'=>'Qty harus diisi.',
            'pembelian.*.produk_id.required'=>'Produk harus diisi.',
        ];
    }
}
