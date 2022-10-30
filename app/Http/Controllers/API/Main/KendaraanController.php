<?php

namespace App\Http\Controllers\API\Main;

use App\Http\Controllers\Controller;
use App\Repository\KendaraanRepository;
use App\Repository\ResponseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KendaraanController extends Controller
{
    protected $kendaraanRepo, $response;
    public function __construct(KendaraanRepository $kendaraanRepo, ResponseRepository $response)
    {
        $this->kendaraanRepo = $kendaraanRepo;
        $this->response = $response;
    }

    public function storeMotor(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "mesin" => 'required|string|min:3|unique:motors',
            "tipe_suspensi" => 'required|string|min:5',
            "tipe_transmisi" => 'required|string|min:5',
            "tahun_keluaran" => 'required|string|min:4',
            "warna" => 'required|string|min:3',
            "harga" => 'required|numeric'
        ]);
        
        if ($validator->fails()) {
            return $this->response->responseError($validator->errors(), "Validation Error!", 400);
        }

        try {
            $data = $this->kendaraanRepo->storeMotor($request);
            return $this->response->responseSuccess($data,'Successfully store motor!', 200);
        } catch (\Throwable $th) {
            return $this->response->responseError($th->getMessage(),'Failed store motor!', 400);
        }
        
    }

    public function storeMobil(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "mesin" => 'required|string|min:3|unique:motors',
            "kapasitas_penumpang" => 'required|numeric',
            "tipe" => 'required|string|min:5',
            "tahun_keluaran" => 'required|string|min:4',
            "warna" => 'required|string|min:3',
            "harga" => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->response->responseError($validator->errors(), "Validation Error!", 400);
        }

        try {
            $data = $this->kendaraanRepo->storeMobil($request);
            return $this->response->responseSuccess($data,'Successfully store mobil!', 200);
        } catch (\Throwable $th) {
            return $this->response->responseError($th->getMessage(),'Failed store mobil!', 400);
        }
    }

    public function stockKendaraan()
    {
        try {
            $data = $this->kendaraanRepo->stockKendaraan();
            return $this->response->responseSuccess($data,'Successfully get stock kendaraan!', 200);
        } catch (\Throwable $th) {
            return $this->response->responseError($th->getMessage(),'Failed get stock kendaraan!', 400);
        }
    }

}
