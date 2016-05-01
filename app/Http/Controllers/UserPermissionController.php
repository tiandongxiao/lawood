<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserPermissionController extends Controller
{
    private $user = null;

    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user();
    }

    public function index()
    {
        $role_perms = $this->user->rolePermissions();
        $user_perms = $this->user->userPermissions();

        return view('permission.user',compact('role_perms','user_perms'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
