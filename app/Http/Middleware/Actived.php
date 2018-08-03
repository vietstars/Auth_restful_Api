<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Actived
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->activated)//Auth check and AuthUser->activated == 1
        {
            return $next($request); //true jump
        }
        //else

        Auth::logout(); //logout

        return redirect()
        ->route('login') //return login route
        ->withErrors([
            'email' => ['Only activated user can access area!'],
        ]);
    }
}
