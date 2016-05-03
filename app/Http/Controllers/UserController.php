<?php

namespace App\Http\Controllers;

use App\User;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show',compact('user'));
    }

    # 用户所有权限（角色权限，专属权限）
    public function permissions($id)
    {
        $user = User::findOrFail($id);
        $role_perms = $user->rolePermissions()->get(); # 角色权限
        $user_perms = $user->userPermissions()->get(); # 专属权限

        # 为赋予的权限
        $x_perms = Permission::all()->filter(function($item) use($user){
            return !$user->hasPermission($item->id);
        });

        return view('user.perms',compact('id', 'role_perms', 'user_perms', 'x_perms'));
    }

    # 用户的角色信息
    public function roles($id)
    {
        $user = User::findOrFail($id);
        $user_roles = $user->roles;

        $x_roles = Role::all()->filter(function($item) use($user){
            return !$item->users->contains($user);
        });

        return view('user.roles',compact('id', 'user_roles', 'x_roles'));
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
    public function attachPermission($user_id,$perm_id)
    {
        $user = User::findOrFail($user_id);
        $perm = Permission::findOrFail($perm_id);

        $user->attachPermission($perm);

        return back();
    }

    # 解除权限
    public function detachPermission($user_id,$perm_id)
    {
        $user = User::findOrFail($user_id);
        $perm = Permission::findOrFail($perm_id);

        $user->detachPermission($perm);

        return back();
    }
}
