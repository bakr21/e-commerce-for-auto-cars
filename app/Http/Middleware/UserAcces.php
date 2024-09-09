<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAcces
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next ,$UserType): Response
    // {
    //     if(auth()->user()->type == $UserType){
    //         return $next($request);
    //     }
    //     return response()->json(['message' => 'Unauthorized'], 401);
    // }

    public function handle(Request $request, Closure $next, $UserType)
    {
        // Check if the authenticated user's type matches $UserType
        if (auth()->check() && auth()->user()->type == $UserType) {
            return $next($request); // User is authorized, proceed with the request
        }

        // If user's type doesn't match $UserType, return 401 Unauthorized response
        return response()->view('errors.403', [], 403);

    }
}
