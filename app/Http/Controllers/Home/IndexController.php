<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
	/**
     * @brief 首页
     * @param string $param
     * @return array|string
     */
    public function index()
    {
    	return view('/home/personal/index');
    }


    public function userInfo()
    {
    	return view('/home/personal/index');
    }
}
