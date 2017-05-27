<?php
 namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

    /**
<<<<<<< HEAD
     * Handle an incoming request.
=======
     * 指定从 CSRF 验证中排除的URL
>>>>>>> c918903a18c69ca6b3fd7fddfabb2daab3d31118
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 使用CSRF
        //return parent::handle($request, $next);
        // 禁用CSRF
        return $next($request);
    }


    protected $except = [
        'home-personal-getUserOrder',
        'home-personal-getOrderGoods',
        'home-personal-getUserInfo',
        'home-personal-getUserAddress',
        'home-personal-getCountAddress',
        'home-personal-getPoint'
    ];
}

