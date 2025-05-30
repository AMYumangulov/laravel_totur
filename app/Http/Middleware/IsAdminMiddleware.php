<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        dd($request->getRequestUri());
        //dd($request->getMethod());
        if (auth()->user()->is_admin) {
            return $next($request);
        }
        return response([
            'message'=>'forbidden'
        ], Response::HTTP_UNAUTHORIZED);

    }
}
