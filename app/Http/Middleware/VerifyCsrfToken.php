<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * 指定从 CSRF 验证中排除的URL
     *
     * @var array
     */
    protected $except = [
        'home-personal-getUserOrder',
        'home-personal-getOrderGoods',
        'home-personal-getUserInfo',
        'home-personal-getUserAddress',
    ];
}
