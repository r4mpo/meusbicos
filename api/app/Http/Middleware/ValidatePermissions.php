<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class ValidatePermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route = Route::currentRouteName();
        $user = auth()->user();

        $permission = $user->can($route);

        if(!$permission){
            throw new \Exception('unauthorized access route');
        }

        return $next($request);
    }
}
