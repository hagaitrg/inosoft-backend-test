<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Motor extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'motors';

    public $fillable = ['id', 'mesin','tipe_suspensi','tipe_transmisi'];

    public function kendaraans()
    {
        return $this->hasMany(Kendaraan::class, 'motor_id');
    }
}
