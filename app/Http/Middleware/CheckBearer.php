<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiKey;

class CheckBearer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $bearer = $request->bearerToken();
        if(empty($bearer)) {
            return response()->json([
                'status' => 401,
                'message' => "Unauthorized" 
            ],401);
        } else {

            $apiKey = ApiKey::where('key', $bearer)->first();
            if(empty($apiKey)) {
                return response()->json([
                    'status' => 401,
                    'message' => "key not registered" 
                ],401);
            } else {
                return $next($request);
            }

        }
    }
}
