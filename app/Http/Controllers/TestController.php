<?php

namespace App\Http\Controllers;



use App\Category;
use App\Traits\GdYunMapTrait;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;

use Shop;
use Illuminate\Support\Facades\Auth;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;


class TestController extends Controller
{
    use GdYunMapTrait;

    public function getMakeCategories()
    {
        $root = Category::where('name','root')->first();
        dd($root->tree());
    }

    public function drawCategory()
    {
        $root = Category::where('name','root')->first();
        //$root = Category::findOrFail(0)->first();
        $nodes = $root->tree()[0]['nodes'];
        return view('index',compact('nodes'));
    }

    public function getHttpLocation()
    {
        //$this->createTable();
        //$this->addItem("王国营","北京市融科橄榄城","家庭");
        //$this->deleteItem('15,16');
        //$this->updateItem('20','田东晓','北京市车道沟北京气象局','旅游');
        //$this->searchItemById(20);
//        $condition = [
//            'city' => '北京市',
//        ];
//        $this->searchLocal($condition);

//        $condition =[
//            'center' => '116.481471,39.990471',
//        ];
//        $this->searchAround($condition);

        $condition = [
            'filter' => '_name:王国营+category:家庭'
        ];
        dd($this->searchByFilter($condition));
    }

    public function getLocations()
    {
        dd(Auth::user()->locations);
    }

    public function ratingUser()
    {
        $user = User::first();
        $user_2 = User::find(2);

        $user->rating([
            'rating' => rand(1,5)
        ],$user_2);

        $rating = ceil($user->averageRating());

        dd($rating);
    }

    public function addRole()
    {
        $adminRole = Role::first();
        $user = User::find(1);
        $user->attachRole($adminRole); // you can pass whole object, or just an id

        dd($user->isAdmin());
    }

    public function accountInfo()
    {
        $user = Auth::user();
        if($user->is('admin|lawyer',true)){
            dd('我是管理员');
        }


//        if($user->isAdmin()){
//            dd('我是管理员');
//        }elseif($user->isLawyer()){
//            dd('我是律师');
//        }elseif($user->isClient()){
//            dd('我是注册用户');
//        }else{
//            dd('I am what I am');
//        }
    }

    public function accountSystem()
    {
        $lawyer = new User();
        $lawyer->email = 'lawyer@lawood.cn';
        $lawyer->password = bcrypt('20022002');
        $lawyer->save();

        $lawyerRole = $this->lawyerRole();
        $lawyer->attachRole($lawyerRole);

        $client = new User();
        $client->email = 'client@lawood.cn';
        $client->password = bcrypt('20022002');
        $client->save();

        $clientRole = $this->clientRole();
        $client->attachRole($clientRole);

        $admin = new User();
        $admin->email = 'admin@lawood.cn';
        $admin->password = bcrypt('20022002');
        $admin->save();

        $adminRole = $this->adminRole();
        $admin->attachRole($adminRole);
        $admin->attachRole($lawyerRole);
    }

    public function hasRole($name)
    {
        $user = Auth::user();
        dd($user->hasRole('admin'));
    }

    public function createRole($name)
    {
        if(!$this->isRoleExist($name)){
            $role = Role::create([
                'name' => ucfirst($name),
                'slug' => $name,
                'description' => '',  # optional
                'level' => 2,         # optional, set to 1 by default
            ]);
            return $role;
        }

        return Role::where('name',ucfirst($name))->first();
    }

    public function createPermission()
    {
        $admin = User::where('email','admin@lawood.cn')->first();

        $createUsersPermission = Permission::create([
            'name' => 'oo user',
            'slug' => 'oo.user',
            'description' => '', // optional
        ]);

        $deleteUsersPermission = Permission::create([
            'name' => 'xx user',
            'slug' => 'xx.user',
        ]);

        $admin->attachPermission($createUsersPermission);
        $admin->attachPermission($deleteUsersPermission);
    }

    public function userPerms()
    {
        $user = Auth::user();
        $perms = $user->userPermissions;
        dd($perms);

    }


    public function rolePerms($role_name)
    {
        $role = Role::where('name',ucfirst($role_name))->first();
        $name = Str::random(2);

        $permission = Permission::create([
            'name' => $name.' users',
            'slug' => $name.'.user',
            'description' => '', // optional
        ]);

        $role->attachPermission($permission);
        $perms = $role->permissions;
        dd($perms);

    }

    public function blade()
    {
        return view('test.perms');
    }

    public function adminRole()
    {
        return $this->createRole('admin');
    }

    public function lawyerRole()
    {
        return $this->createRole('lawyer');
    }

    public function clientRole()
    {
        return $this->createRole('client');
    }

    public function isRoleExist($name)
    {
        $role = Role::where('name',ucfirst($name))->first();

        if(is_object($role)){
            return true;
        }

        return false;
    }

    public function cando()
    {
        $user = Auth::user();

        if($user->can('oo.user')){
            dd('我可以oo用户');
        }

        dd('我不能创建用户');
    }
}
