<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;
use App\Models\Log;
use App\Models\Userteacher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthTeacher extends Controller
{
    public function login_teacher(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_mut' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $credentials = $validator->validated();

        $userTeacher = UserTeacher::where('email_mut', $credentials['email_mut'])->first();

        if (!$userTeacher || !Hash::check($credentials['password'], $userTeacher->password)) {
            return response()->json("email atau password salah",422);
        }

        $payload = [
            'name_mut' => $userTeacher->name_mut,
            'role_mut' => $userTeacher->role_mut,
            'id_mut'=> $userTeacher->id_mut,
            'iat'  => now()->timestamp,
            'exp'  => now()->timestamp + 7200
        ];

        $token = JWT::encode($payload,env('JWT_SECRET_KEY'),'HS256');

        Log::create([
            'module' => 'login',
            'action' => 'login akun',
            'useraccess' => $userTeacher->email_mut
        ]);

        //$token = $userTeacher->createToken('AuthToken')->plainTextToken;

        return response()->json([
            "data" => [
                'msg' => "berhasil login",
                'name' => $userTeacher->name_mut,
                'email'=> $userTeacher->email_mut,
                'role' => $userTeacher->role_mut,
                'id_mut'=> $userTeacher->id_mut,
            ],
            "token" => "Bearer {$token}"
        ],200);
    }
}
