<?php

namespace patholab\Http\Middleware;

use Closure;
use patholab\Report;
use patholab\User;
use Illuminate\Support\Facades\Auth;

class mindYourBusiness
{
    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_id = User::where(['username'=>Auth::user()->username])
        ->select('id')->get();

        $report_user_id = Report::where(['id'=>$request->id])->select('user_id')->get();
        
        if((int)$report_user_id[0]['user_id'] !== (int)$user_id[0]['id'])
        {
            return response('You are not supposed to be here!', 403);
        }
        return $next($request);
    }
}
