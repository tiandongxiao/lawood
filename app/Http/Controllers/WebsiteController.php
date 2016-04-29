<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{

    public function index()
    {
        //return view('index');
        return view('website.snow');
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function regByQrCode()
    {
        return view('auth.qr_code');
    }
}
