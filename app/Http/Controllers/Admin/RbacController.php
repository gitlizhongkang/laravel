<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rules\In;


class RbacController extends Controller
{
    /**
     * @brief 管理员信息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView()
    {
        //从redis读取
        if(Redis::exists('dataAdmin'))
        {
            $data = Redis::get('dataAdmin');
            $dataAdmin = unserialize($data);
        }
        else
        {
            $dataAdmin = Admin::all(['id', 'name', 'email', 'created_at', 'updated_at'])->toArray();

            //循环联查询角色权限
            foreach ($dataAdmin as $key => $val)
            {
                $re = DB::table('role_user')
                    ->where('role_user.user_id' , $val['id'])
                    ->join('roles' , 'roles.id' , '=' , 'role_user.role_id')
                    ->join('permission_role' , 'permission_role.role_id' , '=' ,'role_user.role_id')
                    ->join('permissions' , 'permissions.id' , '=' , 'permission_role.permission_id')
                    ->select(['permissions.name as p_name' , 'roles.name as r_name'])
                    ->get()
                    ->toArray();

                //处理数组
                $role = [];
                $permission = [];
                foreach ($re as $k => $v)
                {
                    //角色
                    if (!in_array($v->r_name, $role))
                    {
                        $role[] = $v->r_name;
                    }
                    //权限
                    if (!in_array($v->p_name, $permission))
                    {
                        $permission[] = $v->p_name;
                    }
                }

                $dataAdmin[$key]['role'] = implode(',', $role);
                $dataAdmin[$key]['permission'] = implode(',', $permission);
            }

            //存入redis
            $data = serialize($dataAdmin);
            Redis::setex('dataAdmin', 1200, $data);
        }



        //赋值渲染
        return view('admin.rbac-admin', ['dataAdmin' => $dataAdmin]);
    }



    /**
     * @brief 角色展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function roleView()
    {
        $dataRole = Role::all();

        return view('admin.rbac-role', ['dataRole' => $dataRole]);
    }


    /**
     * @brief 角色添加
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function addRole()
    {
        $dataInfo = Input::get();
        unset($dataInfo['_token']);

        $db = new Role();
        $db->add($dataInfo);
        $db->save();

        //跳转
        return redirect('/admin-rbac-roleView');
    }



    /**
     * @brief 绑定角色页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bindRoleToUserView()
    {
        $roleId = Input::get('id');
        $roleName = Input::get('name');

        $dataAdmin = Admin::all();

        return view('admin.rbac-bindRoleToUser', ['dataAdmin' => $dataAdmin, 'roleId' => $roleId, 'roleName' => $roleName]);
    }


    /**
     * @brief 检测管理员是否拥有此角色
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function checkRoleToUser()
    {
        $adminId = Input::get('adminId');
        $roleId = Input::get('roleId');

        //检测关系表
        $bool = DB::table('role_user')
            ->where(['user_id' => $adminId, 'role_id' => $roleId])
            ->first();

        if ($bool)
        {
            return response()->json([
                'code' => 1,
                'msg'  => '此管理员已拥有此角色'
            ]);
        }

        return response()->json([
            'code' => 0,
        ]);
    }


    /**
     * @brief 绑定管理员此角色
     */
    public function bindRoleToUser()
    {
        $roleId = Input::get('role_id');
        $adminId = Input::get('admin_id');

        //判断多管理员添加
        if (is_array($adminId))
        {
            foreach ($adminId as $val)
            {
                $admin = Admin::where('id', $val)->first();
                $admin->attachRole($roleId);
            }
        }
        else
        {
            $admin = Admin::where('id', $adminId)->first();
            $admin->attachRole($roleId);
        }

        //删除redis缓存
        Redis::delete('dataAdmin');


        return redirect('/admin-rbac-roleView');
    }




    public function permissionView()
    {
        $dataPermission = Permission::all();

        return view('admin.rbac-permission', ['dataPermission' => $dataPermission]);
    }

    public function addPermission()
    {
        $dataInfo = Input::get();
        unset($dataInfo['_token']);

        $db = new Permission();
        $db->add($dataInfo);
        $db->save();

        //跳转
        return redirect('/admin-rbac-permissionView');
    }

    public function bindPermissionToRoleView()
    {
        $permissionId = Input::get('id');
        $permissionName = Input::get('name');

        $dataRole = Role::all();

        return view('admin.rbac-bindPermissionToUser', ['dataRole' => $dataRole, 'permissionId' => $permissionId, 'permissionName' => $permissionName]);
    }

    public function checkPermissionToRole()
    {
        $roleId = Input::get('roleId');
        $permissionId = Input::get('permissionId');

        //检测关系表
        $bool = DB::table('permission_role')
            ->where(['permission_id' => $permissionId, 'role_id' => $roleId])
            ->first();

        if ($bool)
        {
            return response()->json([
                'code' => 1,
                'msg'  => '此管理员已拥有此角色'
            ]);
        }

        return response()->json([
            'code' => 0,
        ]);
    }

    public function bindPermissionToRole()
    {
        $permissionId = Input::get('permission_id');
        $roleId = Input::get('role_id');


        //判断多管理员添加
        if (is_array($roleId))
        {
            foreach ($roleId as $val)
            {
                $role = Role::where('id', $val)->first();
                $role->attachPermission($permissionId);
            }
        }
        else
        {
            $role = Role::where('id', $roleId)->first();
            $role->attachPermission($permissionId);
        }

        //删除redis缓存
        Redis::delete('dataAdmin');

        return redirect('/admin-rbac-permissionView');
    }
}