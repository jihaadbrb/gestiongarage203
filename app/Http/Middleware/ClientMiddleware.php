<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClientMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'client') {
            return $next($request);
        }
        
        // If the user is not a client, you might want to redirect them or return an error response
        return redirect()->route('welcome')->with('error', 'You do not have permission to access this page.');
    }
}
