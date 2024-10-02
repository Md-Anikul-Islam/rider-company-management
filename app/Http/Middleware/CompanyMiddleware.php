<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role == 'company') {
            return $next($request);
        }

        return redirect('/'); // Redirect to a default page if unauthorized
    }

}
