<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLogin
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
        //dd($request->session()->get('admin'));
//        dd(Auth::guard('admin')->user()->name);

        if (!Auth::guard('admin')->user()){
            return redirect('/admin/login');
        }
        return $next($request);//继续执行
    }
}
