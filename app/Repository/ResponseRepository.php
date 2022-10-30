<?php 

namespace App\Repository;

interface ResponseStruct {
    public function responseSuccess($data, $message, $code);
    public function responseError($data, $message, $code);
}

class ResponseRepository implements ResponseStruct {
    public function responseSuccess($data, $message, $code)
    {
        $response = [
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response,$code);
    }

    public function responseError($data, $message, $code)
    {
        $response = [
            'success' => false,
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response,$code);
    }
}