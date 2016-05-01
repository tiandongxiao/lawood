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
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $users = User::all();
        dd($users);
        return view('user.index',compact('users'));
    }
    

    
    public function permissions($id)
    {
        $user = User::findOrFail($id);
        $role_perms = $user->rolePermissions();
        $user_perms = $user->userPermissions();
        $permissions = Permission::all();

        return view('permission.user',compact('role_perms','user_perms','permissions'));
    }

    public function roles($id)
    {
        $user = User::findOrFail($id);
        $user_roles = $user->roles;
        $roles = Role::all();
        return view('user.role',compact('user_roles','roles'));        
    }

    public function attachRole($user_id,$role_id)
    {
        $user = User::findOrFail($user_id);
        $user->attachRole($role_id);
        return back();
    }

    public function detachRole($user_id,$role_id)
    {
        $user = User::findOrFail($user_id);
        $user->detachRole($role_id);
        return back();
    }

    public function attachPermission($user_id,$permission_id)
    {
        $user = User::findOrFail($user_id);
        $user->attachPermission($permission_id);
        return back();
    }

    public function detachPermission($user_id,$permission_id)
    {
        $user = User::findOrFail($user_id);
        $user->detachPermission($permission_id);
        return back();
    }
}
