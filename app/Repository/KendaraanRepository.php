<?php 
namespace App\Repository;

use App\Models\Kendaraan;
use App\Models\Mobil;
use App\Models\Motor;
use Illuminate\Http\Request;

interface KendaraanStruct {
    public function storeMotor(Request $request);
    public function storeMobil(Request $request);
    public function stockKendaraan();
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

    public function storeMobil(Request $request)
    {
        $mobil = new Mobil();
        $mobil->mesin = $request->mesin;
        $mobil->kapasitas_penumpang = $request->kapasitas_penumpang;
        $mobil->tipe = $request->tipe;
        $mobil->save();

        $kendaraan = new Kendaraan();
        $kendaraan->mobil_id =$mobil->id;
        $kendaraan->tahun_keluaran = $request->tahun_keluaran;
        $kendaraan->warna = $request->warna;
        $kendaraan->harga = $request->harga;
        $kendaraan->save();

        return [$mobil,$kendaraan];
    }

    public function stockKendaraan()
    {
        $kendaraans = Kendaraan::count();
        $motors = Motor::all();
        $dataMotor = [];
        foreach ($motors as $motor) {
            $kendaraan = Kendaraan::where('motor_id', $motor->id)->get();
            array_push($dataMotor, $motor,$kendaraan);
        }
        $mobils = Mobil::all();
        $dataMobil = [];
        foreach ($mobils as $mobil) {
            $kendaraan = Kendaraan::where('mobil_id', $mobil->id)->get();
            array_push($dataMobil, $mobil,$kendaraan);
        }

        $data = [
            "stock kendaraan" => $kendaraans,
            "motor" => $dataMotor,
            "mobils" => $dataMobil
        ];

        return $data;
    }

}
