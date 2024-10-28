<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }
        return response()->json(['message' => 'Unauthorized.'], 403);
    }
}


// Check if the user is authenticated and has the admin role
        // if (Auth::check() && Auth::user()->role === 'admin') {
        //     return $next($request);
        // }

        // // Redirect non-admin users to home or respond with 403 Unauthorized
        // return Auth::check()
        // ? response()->json(['message' => 'Unauthorized.'], 403)
        //     : redirect('/login');


        // // If user is not authenticated, let 'auth' middleware handle it
        // if (!Auth::check()) {
        //     return redirect('/login');
        // }

        // // If authenticated, but not admin, return Unauthorized response
        // if (Auth::user()->role !== 'admin') {
        //     return response()->json(['message' => 'Unauthorized.'], 403);
        // }

        // // Proceed for authenticated admin
        // return $next($request);
