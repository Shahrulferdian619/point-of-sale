<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $guarded = [];

    public function penjualanRinci(){
        return $this->hasMany(PenjualanRinci::class, 'penjualan_id');
    }
}
