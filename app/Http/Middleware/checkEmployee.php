<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class checkEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->usertype == 1) {
            return $next($request);
        }

        if (Auth::user()->usertype == 2) {
            return redirect()->route('tickets.index');
        }

        if (Auth::user()->usertype == 3) {
            return redirect()->route('tickets.index');
        }
    }
}
