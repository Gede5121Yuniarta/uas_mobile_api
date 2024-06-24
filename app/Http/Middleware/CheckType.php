<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckType
{
    public function handle($request, Closure $next, $type)
    {
        if (Auth::user()->type !== $type) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
