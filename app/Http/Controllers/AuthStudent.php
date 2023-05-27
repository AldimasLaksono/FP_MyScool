<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;
use App\Models\Log;
use App\Models\Userstudent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthStudent extends Controller
{
    public function login_student(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_mus' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $credentials = $validator->validated();

        $userstudent = Userstudent::where('email_mus', $credentials['email_mus'])->first();

        if (!$userstudent || !Hash::check($credentials['password'], $userstudent->password)) {
            return response()->json("email atau password salah",422);
        }

        $payload = [
            'name_mus' => $userstudent->name_mus,
            'id_mus'=> $userstudent->id_mus,
            'iat'  => now()->timestamp,
            'exp'  => now()->timestamp + 7200
        ];

        $token = JWT::encode($payload,env('JWT_SECRET_KEY'),'HS256');

        Log::create([
            'module' => 'login',
            'action' => 'login akun',
            'useraccess' => $userstudent->email_mus
        ]);

        //$token = $userTeacher->createToken('AuthToken')->plainTextToken;

        return response()->json([
            "data" => [
                'msg' => "berhasil login",
                'name' => $userstudent->name_mus,
                'email'=> $userstudent->email_mus,
                'id_mus'=> $userstudent->id_mus,
            ],
            "token" => "Bearer {$token}"
        ],200);
    }
}
