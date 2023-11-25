<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if(!auth()->check()){
            return redirect('login');
        }

        $user = auth()->user();
        if(in_array($user->role,$roles)){
            return $next($request);
        }
        return redirect('home')->with('error','You won\'t have acces to this page.');
    }
}
