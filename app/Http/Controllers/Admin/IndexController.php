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
<<<<<<< HEAD
        $arr=Input::all();
        $data = DB::table('admin')->where([
                ['admin_name',  $arr['admin_name']],
                ['admin_pwd',  md5($arr['admin_pwd'])],
            ])->first();

            if ($data)
            {
                //查看权限
                $admin_id = $data->admin_id;
                Session::put('id',$admin_id);  
                $id = Session::get('id');
                $data = DB::table('admin_part')
                    ->select('part_name')
                    ->where('admin_id',$id)
                    ->get()->first();
                    foreach ($data as $key => $v) {}
                Session::put('part_name',$v);
                $success = ['status'=>2,'success'=>'登录成功'];
            }
            else
            {
                $success = ['status'=>1,'success'=>'账号密码不正确'];
            }

        return $success;
    }
=======
        //非法登陆
        $user = Auth::user();
>>>>>>> 14a25e91ca1297ecd2584ecb4e26ea242b682e82

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