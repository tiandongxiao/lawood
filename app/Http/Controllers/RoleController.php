<?php

namespace App\Http\Controllers;

use Bican\Roles\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    # 列举所有角色
    public function index()
    {
        $roles = Role::all();
        return view('role.index',compact('roles'));
    }

    # 创建新角色
    public function create()
    {
        return view('role.create');
    }

    # 保存新的角色
    public function store(Request $request)
    {
        $name = trim($request->get('name'));
        $slug = trim($request->get('slug'));

        $role = Role::create([
            'name'        =>  $name,
            'slug'        =>  $slug,
            'description' =>  $request->get('desc')
        ]);

        if($role){
            return redirect('role');
        }else{
            return back()->withInput()->withErrors('创建失败');
        }
    }

    # 显示角色具体信息
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $permissions = $role->permissions;
        return view('role.show',compact('role','permissions'));
    }

    # 编辑角色信息
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('role.edit',compact('role'));
    }

    # 更新角色信息
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $name = trim($request->get('name'));
        $slug = trim($request->get('slug'));

        $role->name = $name;
        $role->slug = $slug;

        $role->description = $request->get('desc');

        if ($role->save()) {
            return redirect('role');
        } else {
            return back()->withInput()->withErrors('更新失败！');
        }
    }

    # 删除角色信息
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return back();
    }
}
