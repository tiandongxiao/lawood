<?php

namespace App\Http\Controllers;

use App\User;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    # 只有管理员可以访问
    public function __construct()
    {
        //$this->middleware('role:admin');
    }

    # 所有用户信息
    public function index()
    {
        $users = User::findRequested();        
        return view('user.index',compact('users'));
    }

    # 用户所有权限（角色权限，专属权限）
    public function permissions($id)
    {
        $user = User::findOrFail($id);
        $role_perms = $user->rolePermissions(); # 角色权限
        $user_perms = $user->userPermissions(); # 专属权限

        # 为赋予的权限
        $x_permissions = Permission::all()->filter(function($item) use($user){
            return $item->user_id != $user->id;
        });

        return view('permission.user',compact('role_perms','user_perms','x_permissions'));
    }

    # 用户的角色信息
    public function roles($id)
    {
        $user = User::findOrFail($id);
        $user_roles = $user->roles;
        $roles = Role::all();
        return view('user.role',compact('user_roles','roles'));        
    }

    # 绑定角色
    public function attachRole($user_id,$role_id)
    {
        $user = User::findOrFail($user_id);
        $user->attachRole($role_id);
        return back();
    }

    # 解除角色
    public function detachRole($user_id,$role_id)
    {
        $user = User::findOrFail($user_id);
        $user->detachRole($role_id);
        return back();
    }

    # 绑定权限
    public function attachPermission($user_id,$permission_id)
    {
        $user = User::findOrFail($user_id);
        $user->attachPermission($permission_id);
        return back();
    }

    # 解除权限
    public function detachPermission($user_id,$permission_id)
    {
        $user = User::findOrFail($user_id);
        $user->detachPermission($permission_id);
        return back();
    }
}
