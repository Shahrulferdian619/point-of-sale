<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianRinci extends Model
{
    use HasFactory;

    protected $table = 'pembelian_rinci';
    protected $guarded = [];

    public function produk (){
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
