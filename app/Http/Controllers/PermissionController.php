<?php

namespace App\Http\Controllers;

use App\Traits\PermissionDevTrait;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    use PermissionDevTrait;

    # 列举所有权限信息
    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::all();

        return view('permission.index',compact('permissions','roles'));
    }

    # 创建新的权限
    public function create()
    {
        return view('permission.create');
    }

    # 保存一个新权限
    public function store(Request $request)
    {
        $name = trim($request->get('name'));
        $slug = trim($request->get('slug'));

        $permission = Permission::create([
            'name'        =>  $name,
            'slug'        =>  $slug,
            'description' =>  $request->get('desc')
        ]);
        if($permission){
            $this->authToAdmin($permission);
            return redirect('permission');
        }else{
            return back()->withInput()->withErrors('创建失败');
        }
    }

    # 显示某权限具体信息
    public function show($id)
    {
        $permission = Permission::findOrFail($id);

        return view('permission.show',compact('permission'));
    }

    # 修改某个权限信息
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $roles = Role::all();

        return view('permission.edit',compact('permission','roles'));
    }

    # 更新某个权限信息
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->name = $request->get('name');
        $permission->slug = $request->get('slug');
        $permission->description = $request->get('desc');

        $role_array = $request->get('role');

        if ($permission->save()) {
            $this->authPermission($permission,$role_array);
            return redirect('permission');
        } else {
            return back()->withInput()->withErrors('更新失败！');
        }
    }

    # 删除某个权限信息
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect('permission');
    }
}
