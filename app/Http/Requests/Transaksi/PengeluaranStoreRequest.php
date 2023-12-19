<?php

namespace App\Http\Requests\Transaksi;

use Illuminate\Foundation\Http\FormRequest;

class PengeluaranStoreRequest extends FormRequest
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
        // dd('teeesssttt');
        $this->merge([
            'nominal'=>converter($this->input('nominal'))
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
            'nominal'=>'required|numeric',
            'keterangan'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'nominal.required' => 'Nominal harus diisi.',
            'keterangan.required' => 'Keterangan harus diisi.',
            'nominal.numeric' => 'Nominal harus berupa angka.',
        ];
    }
}
