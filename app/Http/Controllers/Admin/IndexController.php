<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class IndexController extends Controller
{

    /**
     * 登录页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //非法登陆
        $user = Auth::user();

        if (empty($user))
        {
            return redirect('/admin-login-view');
        }


        return view('admin.index', ['user' => $user]);
    }


    /**
     * @brief 退出登录
     * @return\Illuminate\Routing\Redirector|void
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/admin-login-view');
    }





}