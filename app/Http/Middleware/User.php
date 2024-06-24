<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     $user = Auth::user();

    //     if ($user && $user->type === 'user') {
    //         return $next($request);
    //     }

    //     return redirect('/');
    // }

    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && auth()->user()->type === 'user') {
            return $next($request);
        }

        return redirect('/'); // Redirect ke halaman lain jika bukan user
    }

}
