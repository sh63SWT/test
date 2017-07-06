<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminUse
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
        $result = Auth::guard('admin')->user()->status;
        $result2 = Auth::guard('admin')->user()->id;
//        dd($result2);
        //超级管理员和高级管理员可以查看
        //        超级管理员可以管高级和普通
        //        高级管理员只能管普通管理员
//        if($result == 0 || $result == 1)
//        {
            return $next($request);
//        }else{
//            return  back();
//        }

    }
}
