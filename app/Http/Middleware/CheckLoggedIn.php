<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLoggedIn
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('loggedIn')) {
            return redirect()->route('loginl');
        }

        return $next($request);
    }
}
