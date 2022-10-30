<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repository\ResponseRepository;
use Carbon\Carbon;

class UserController extends Controller
{
    protected $response;

    public function __construct(ResponseRepository $response)
    {
        $this->response = $response;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50',
            'confirm_password' => 'required|string|min:6|max:50|same:password',
        ]);

        if ($validator->fails()) {
            return $this->response->responseError($validator->errors(), "Validation Error!", 400);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = Carbon::now()->timestamp;
        $user->password = bcrypt($request->password);

        try {
            $user->save();
            return $this->response->responseSuccess($user, "Successfully register user!", 200);
        } catch (\Throwable $th) {
            return $this->response->responseError($th->getMessage(), "Failed register user!", 400);
        }
    }
}
