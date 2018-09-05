<?php

namespace App\Http\Controllers\admin;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class MainsController extends Controller
{
    //主页面管理控制器


    public function index()
    {
        $roles = Role::where('id',Auth::guard('admin')->User()->role_id)->first();
        $roleArr = explode('|',$roles->per_id);

        $navs = Permission::whereIn('id',$roleArr)->get();
        return view('admin.mains.main',compact('navs'));
    }

    public function welcome()
    {
        return view('admin.mains.welcome');
    }
}
