<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\AdminValidate;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class AdminsController extends Controller
{
    //管理员管理控制器



    //管理员管理展示页面
    public function index()
    {
        $admins = Admin::paginate(10);
        return view('admin.managers.admins_index',compact('admins'));
    }

    public function show(Admin $admin){

    }

    //管理员创建
    public function create()
    {
        $roles = Role::get();
        return view('admin.managers.admins_create',compact('roles'));
    }

    //管理员创建处理
    public function store(AdminValidate $request)
    {

        Admin::create([
            'account' => $request -> account,
            'password' => bcrypt($request->password),
            'name' => $request -> name,
            'role_id' => $request -> role_id,
            'status' => $request -> status,
            'remarks' => $request ->remarks,
        ]);

        return redirect()->route('admins.index');
    }

    //管理员状态更新
    public function status(Request $request)
    {
        $data = [];
        $data['id'] = $request -> id;
        $data['status'] = $request->status ? null : 1;
        $manager = new Admin();
        $resource = $manager -> where('id',$data['id']) -> update($data);
        $msg = $resource ? '帐户状态已更新' : '帐户状态更新失败';
        return response()->json(['code'=>1,'msg'=>$msg]);
    }

    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('admin.managers.admins_update',compact('admin','roles'));
    }

    public function update(Request $request)
    {
        var_dump($request->all());
    }

    public function destroy(Admin $admin)
    {
        $resource = $admin -> delete();
        return $resource ? response()->json(['code'=>1,'msg'=>'管理员删除成功']) : response()->json(['code'=>0,'msg'=>'管理员删除失败']);
    }





}

