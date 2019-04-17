<?php

namespace App\Http\Middleware;

use Closure;

class CheKLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $link=session('links');
        // dd($link);
        if(session('links')==null){
            return redirect()->to('/');
        }
        return $next($request);
    }
}
