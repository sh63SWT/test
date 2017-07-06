<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Route;

class Rbac
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
        //获取当前访问的路由
        $route = Route::current()->uri();
        //dump($route);
        //可以从session将当前用户的id查询出来。
        //当前用户的模型
        $user = User::find(1);
        dump($user->can($route));   //判断当前用户的使用具有多当前路由访问的权限
        if(!$user->can($route)){
            //说明没有权限，返回到上一个页面
            return back();
        }
        //继续向下执行
        return $next($request);
    }
}
