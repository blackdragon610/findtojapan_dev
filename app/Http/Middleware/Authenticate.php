<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $guard = "user";

        if (isset($guards[0])){
            if ($guards[0] == "company"){
                $guard = "company";
            }
            if ($guards[0] == "admin"){
                $guard = "admin";
            }
        }


        if (!Auth::guard($guard)->check()) {
            // 非ログインはログインページに飛ばす
            if ($guard == "company"){
                return redirect('/company/login');
            }else{
                return redirect('/admin/login');
            }
        }

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @param  array  $guards
     * @return string|null
     */
    protected function redirectTo($request)
    {

            dd("www");
            return "admin/login";
    }
}
