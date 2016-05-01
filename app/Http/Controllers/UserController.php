<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $user;
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user();
    }
    
    public function permissions()
    {
        $role_perms = $this->user->rolePermissions();
        $user_perms = $this->user->userPermissions();

        return view('permission.user',compact('role_perms','user_perms'));
    }

    public function roles()
    {
        
    }
}
