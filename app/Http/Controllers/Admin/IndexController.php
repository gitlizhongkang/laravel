<?php
namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;  
use App\Models\Admin;
use App\Models\Part;

class IndexController extends Controller
{

	//登录页面
    public function index()
    {
    	return view('admin/login');
    }

    /**
     * @brief 登录验证
     * @return array
     */
    public function login()
    {
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

    //后台主页
    public function login_scs()
    {
        return view('admin/branch');
    }

    /**
     * 查看用户所属权限
     * @brief 方法简介
     * @param $data（数据）
     */
    public function system()
    {
        $data = DB::table('admin')
            ->join('admin_part', 'admin.admin_id', '=', 'admin_part.admin_id')
            ->join('part', 'admin_part.part_name', '=', 'part.name')
            ->select('admin.*', 'part.name')
            ->get();

        return view('admin/system',['data'=>$data]);
    }

    /**
     * //准备添加管理员
     * @brief 方法简介
     * @param $data（数据）
     */
    public function add_admin()
    {   
        $Part = new Part;
        $info = $Part->select();
        $data = $info->toArray();

        return view('admin/add_admin',['data'=>$data]);
    }


    /**
     * 添加管理员
     * //准备添加管理员
     * @brief 方法简介
     * @param $res（添加用户）
     * @param $add（添加该用户角色）
     */
    public function begin_add()
    { 
        $arr=Input::all();
        $ip   = $_SERVER['SERVER_ADDR'];
        $date = date('Y-m-d H:i:s');

        $data = [
                'admin_name' => $arr['admin_name'],
                'admin_pwd'  => md5($arr['admin_pwd']),
                'create_time' => $date,
                'last_ip' => $ip,
            ]; 
        $res = DB::table('admin')->insertGetId($data);
        if ($res)
        {
            $info = [
                'admin_id' => $res,
                'part_name'  => $arr['part'],
            ]; 
            $add = DB::table('admin_part')->insert($info);
            if ($add)
            {
                return redirect('admin-index-system');
            }
        }
    }


}