<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    # 主页
    public function index()
    {
        return view('site.snow');
    }

    public function welcome()
    {
        return view('welcome');
    }

    # about页面
    public function about()
    {
       return view('home.about');
    }
}
