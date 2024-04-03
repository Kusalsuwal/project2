<?php
// app/Http/Middleware/CustomMiddleware.php

namespace App\Http\Middleware;

use Closure;

class CustomMiddleware
{
    public function handle($request, Closure $next)
    {
        // Your middleware logic goes here
        
        return $next($request);
    }
}
