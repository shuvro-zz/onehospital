<?php

namespace patholab\Http\Middleware;

use Closure;
use patholab\User;
use Illuminate\Support\Facades\Auth;

class operator
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
        $operator = User::where(['username'=>Auth::user()->username])
        ->select('operator')
        ->get();
        
        if($operator[0]->operator !== 1)
        {
            return redirect('/');
        }
        return $next($request);
    }
}
