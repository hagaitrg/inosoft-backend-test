<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Kendaraan extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'kendaraans';

    public $fillable = ['id', 'motor_id','mobil_id','tahun_keluaran', 'warna','harga'];

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
