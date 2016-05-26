<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OperatorController extends Controller
{
    public function unapprovedUsers()
    {
        $users = User::where('role','lawyer')->where('active',false)->get();
        return $users;
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->update(['active'=>true]);
        $user->start();
        return back();
    }
}
