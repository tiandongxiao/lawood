<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Permission;
use App\User;
use Bican\Roles\Models\Role;
use Illuminate\Support\Facades\Log;

class UserRolePermSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->delete();
        DB::table('roles')->delete();
        DB::table('users')->delete();

        DB::table('roles')->insert([
            [
                'name' 	        =>  '管理员',
                'slug' 	        =>  'admin',
                'description'   =>  '系统管理员，拥有所有权限',
            ],
            [
                'name' 	        =>  '律师',
                'slug' 	        =>  'lawyer',
                'description'   =>  '平台律师，发布服务，接受用户咨询',
            ],
            [
                'name' 	        =>  '咨询用户',
                'slug' 	        =>  'client',
                'description'   =>  '咨询用户，在平台进行业务咨询',
            ],
            [
                'name' 	        =>  '注册用户',
                'slug' 	        =>  'register',
                'description'   =>  '注册成功，并未选择身份类型的用户',
            ],
            [
                'name' 	        =>  '匿名用户',
                'slug' 	        =>  'anonymous',
                'description'   =>  '匿名用户，未注册，直接进行浏览访问的用户',
            ],
        ]);

        $permissions = collect([
            [
                'name' 	        =>  '创建门类',
                'slug' 	        =>  'category.create',
                'description'   =>  '创建新的平台服务门类',

                # 哪个角色用户可以拥有此权限
                'roles'          =>  ['admin']
            ],
            [
                'name' 	        =>  '删除门类',
                'slug' 	        =>  'category.delete',
                'description'   =>  '删除一个平台服务门类',

                # 哪个角色用户可以拥有此权限
                'roles'          =>  ['admin']
            ],
            [
                'name' 	        =>  '编辑门类',
                'slug' 	        =>  'category.edit',
                'description'   =>  '编辑服务门类信息',

                # 哪个角色用户可以拥有此权限
                'roles'          =>  ['admin']
            ],

            [
                'name' 	        =>  '绑定门类',
                'slug' 	        =>  'category.bind',
                'description'   =>  '绑定新的业务服务种类',

                # 哪个角色用户可以拥有此权限
                'roles'          =>  ['lawyer']
            ],
            [
                'name' 	        =>  '解绑门类',
                'slug' 	        =>  'category.unbind',
                'description'   =>  '解除某个门类，不再提供相关服务',
                'roles'          =>  ['lawyer']
            ],
            [
                'name' 	        =>  '创建地址',
                'slug' 	        =>  'location.create',
                'description'   =>  '用户创建地址，工作地址，家庭住址',
                'roles'          =>  ['lawyer']
            ],
            [
                'name' 	        =>  '删除地址',
                'slug' 	        =>  'location.delete',
                'description'   =>  '用户创建地址，工作地址，家庭住址',
                'roles'          =>  ['lawyer']
            ],
            [
                'name' 	        =>  '构建服务项',
                'slug' 	        =>  'consult.build',
                'description'   =>  '根据业务门类和地址生成服务项',
                'roles'          =>  ['lawyer']
            ],
        ]);
        
        $permissions->each(function($item){
            $perm = Permission::create([
                'name'         =>  $item['name'],
                'slug'         =>  $item['slug'],
                'description'  =>  $item['description']
            ]);

            $roles = $item['roles'];

            foreach ($roles as $slug){
                $role = Role::where('slug',$slug)->first();
                if($role)
                    $role->attachPermission($perm);
            }
        });

        $users = collect([
            [
                # user 本身字段
                'email' 	 => 'admin@lawood.cn',
                'password' 	 => bcrypt('20022002'),
                'role'       => 'admin',

                # 为用户关联其他信息
                'roles'      => ['admin'],   # 角色信息
                'permissions'=> [
                    'category.create',
                    'category.delete',
                    'category.edit'
                ]   # 专属权限
            ]
        ]);

        $users->each(function($item){
            $user = User::create([
                'email'     => $item['email'],
                'password'  => $item['password'],
                'role'      => $item['role']
            ]);

            $roles = $item['roles'];
            foreach ($roles as $slug){
                $role = Role::where('slug',$slug)->first();
                if($role)
                    $user->attachRole($role);
            }
//
            $perms = $item['permissions'];
            foreach ($perms as $slug){
                $permission = Permission::where('slug',$slug)->first();
                if($permission)
                    $user->attachPermission($permission);
            }
        });
    }
}
