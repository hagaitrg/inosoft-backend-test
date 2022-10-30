<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Mobil extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'mobils';

    public $fillable = ['id', 'mesin','kapasitas_penumpang','tipe'];

    public function kendaraans()
    {
        return $this->hasMany(Kendaraan::class, 'mobil_id');
    }
}
