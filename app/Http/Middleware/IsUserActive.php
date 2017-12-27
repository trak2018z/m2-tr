<?php

namespace App\Http\Middleware;

use App\Log;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsUserActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if(!is_null($user) && (!$user->active || is_null($user->active))){
            if($request->expectsJson()){
                return response()->json([
                    "success" => false,
                    "response" => [
                        "message" => "USER_NOT_ACTIVATED"
                    ]
                ], 401);
            } else {
                abort(401);
            }
        }
        return $next($request);
    }
}
