<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     $user = Auth::user();
    //     Log::info('SuperAdmin Middleware: User type - ' . ($user ? $user->type : 'Guest'));

    //     if ($user && $user->type === 'super admin') {
    //         return $next($request);
    //     }

    //     return redirect('/');
    // }

    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && auth()->user()->type === 'super admin') {
            return $next($request);
        }

        return redirect('/'); // Redirect ke halaman lain jika bukan super admin
    }

}
