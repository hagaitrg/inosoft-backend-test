<?php 
namespace App\Repository;

use App\Models\Kendaraan;
use App\Models\Motor;
use Illuminate\Http\Request;

interface KendaraanStruct {
    public function storeMotor(Request $request);
}

class KendaraanRepository implements KendaraanStruct{
    public function storeMotor(Request $request)
    {
        $motor = new Motor();
        $motor->mesin = $request->mesin;
        $motor->tipe_suspensi = $request->tipe_suspensi;
        $motor->tipe_transmisi = $request->tipe_transmisi;
        $motor->save();

        $kendaraan = new Kendaraan();
        $kendaraan->motor_id =$motor->id;
        $kendaraan->tahun_keluaran = $request->tahun_keluaran;
        $kendaraan->warna = $request->warna;
        $kendaraan->harga = $request->harga;
        $kendaraan->save();

        return [$motor,$kendaraan];
    }
}
