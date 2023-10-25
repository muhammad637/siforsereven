<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$cekLevel)
    {
        if(!auth()->check()){
            return redirect('/');
        }
        $userLevel = auth()->user()->cekLevel;
        if(in_array($userLevel,$cekLevel)){
            return $next($request);
        }
        return abort(403,'Unotorized action');
    }
}
