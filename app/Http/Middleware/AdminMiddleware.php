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
    // public function handle(Request $request, Closure $next): Response
    // {
    //     // return $next($request);
    //     if(Auth::check())
    //    {
    //        $user = Auth::user();

    //        if($user->hasRole(['super-admin','admin'])){

    //             return $next($request);

    //        }

    //       abort(403,'User does not have correct role');
    //    }
    //    abort(404);
    // }

    public function handle(Request $request, Closure $next): Response
    {
        // Check if the authenticated user is from the 'web' guard
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();

            if ($user->hasRole(['super-admin', 'admin'])) {
                return $next($request);
            }

            abort(403, 'User does not have the correct role');
        }

        // Check if the user is authenticated as a guest
        if (Auth::guard('guest')->check()) {
            return $next($request); // Allow guests to proceed
        }

        abort(404, 'Not authenticated');
    }
}
