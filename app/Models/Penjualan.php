<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Penjualan extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'penjualans';

    public $fillable = ['id', 'kendaraan_id','total_terjual','total_harga',];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
