<?php

namespace patholab\Http\Middleware;

use Closure;
use \Illuminate\Support\Facades\Auth;
use patholab\User;

class patient
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
        if($operator[0]->operator !== 0)
        {
            return redirect('/');
        }
        return $next($request);
    }
}
