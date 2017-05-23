<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/*
		
 */
class GoodsController extends Controller
{
	/**
		*@brief 商品列表
	 */
    public function index()
    {
    	return view('/home/goods');
    }
}