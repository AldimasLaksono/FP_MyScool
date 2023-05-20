<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT; //panggil library jwt
use App\Models\User; //panggil model user
use App\Models\Log;
use Illuminate\Support\Facades\Validator; //panggil library validator
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthController extends Controller
{
    // public function register(Request $request) {

    //     //buat validasi inputan
    //     $validator = Validator::make($request->all(),[
    //         'name' => 'required',
    //         'email' => 'required|email|unique:user,email',
    //         'password' => 'required|min:8',
    //         'status' => 'required',
    //         'role' => 'required',
    //     ]);

    //     if ($validator->fails()){
    //         return messageError($validator->messages()->toArray());
    //     }

    //     $user = $validator->validated();

    //     User::create($user);

    //     $payload = [
    //         'name'=> $user['name'],
    //         'role' => $user['role'],
    //         'iat' => now()->timestamp,
    //         'exp' => now()->timestamp + 7200
    //     ];

    //     $token = JWT::encode($payload, env('JWT_SECRET_KEY'), 'HS256');

    //     Log::create([
    //         'module' => 'register',
    //         'action' => 'registrasi akun',
    //         'useraccess' => $user['email']
    //     ]);

    //     return response()->json([
    //         "data" => [
    //             'msg' => "berhasil register",
    //             'name' => $user['name'],
    //             'email' => $user['email'],
    //             'role' => $user['role'],
    //         ],
    //         "token" => "Bearer {$token}"
    //     ], 200);
    // }

    public function login(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return messageError($validator->messages()->toArray());
        }

        if(Auth::attempt($validator->validated())) {
            $payload = [
                'name' => Auth::user()->name,
                'role' => Auth::user()->role,
                'id_tmu'=> Auth::user()->id_tmu,
                'iat'  => now()->timestamp,
                'exp'  => now()->timestamp + 7200
            ];

            $token = JWT::encode($payload,env('JWT_SECRET_KEY'),'HS256');

            Log::create([
                'module' => 'login',
                'action' => 'login akun',
                'useraccess' => Auth::user()->email
            ]);

            return response()->json([
                "data" => [
                    'msg' => "berhasil login",
                    'name' => Auth::user()->name,
                    'email'=> Auth::user()->email,
                    'role' => Auth::user()->role,
                    'id_tmu'=> Auth::user()->id_tmu,
                ],
                "token" => "Bearer {$token}"
            ],200);
        }
            return response()->json("email atau password salah",422);
    }
}
