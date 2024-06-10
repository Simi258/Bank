<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfEmployer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)

    {
        if (auth()->check() && auth()->user()->user_type !== 'employer') {
            // User is not an employer, so show error 401(Unauthorized)
            return redirect(401);
        }
        return $next($request);
    }
}
