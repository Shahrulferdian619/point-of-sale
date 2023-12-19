<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';
    protected $guarded = [];

    public function supplier (){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function pembelianRinci (){
        return $this->hasMany(PembelianRinci::class, 'pembelian_id');
    }
}
