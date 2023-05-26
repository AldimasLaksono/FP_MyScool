<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

//library JWT
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $jwt = $request->bearerToken();
            $decoded = JWT::decode($jwt, new Key(env('JWT_SECRET_KEY'), 'HS256'));
    
            if($decoded->role = 'admin'){
                return $next($request);
            } else{
                return response()->json("Unauthorized", 401);
            }
       } catch (ExpiredException $e){
            return response()->json($e->getMessage(), 400);
       }
    }
}
