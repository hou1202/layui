<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainsController extends Controller
{
    //主页面管理控制器


    public function index()
    {
        return view('admin.mains.main');
    }

    public function welcome()
    {
        return view('admin.mains.welcome');
    }
}
