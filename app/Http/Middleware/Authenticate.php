<?php

// app/Http/Middleware/Authenticate.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        // Authentication logic goes here
        // For example:
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
