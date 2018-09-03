<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\ManagerValidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class ManagersController extends Controller
{
    //管理员管理控制器


    //管理员管理展示页面
    public function index()
    {
        $managers = Admin::paginate(10);
        return view('admin.managers.managers_index',compact('managers'));
    }

    //管理员创建
    public function create()
    {
        return view('admin.managers.managers_create');
    }

    //管理员创建处理
    public function store(ManagerValidate $request)
    {

        Admin::create([
            'account' => $request -> account,
            'password' => bcrypt($request->password),
            'name' => $request -> name,
            'role_id' => $request -> authorities,
            'status' => $request -> status,
            'remarks' => $request ->remarks,
        ]);

        return redirect()->route('managers.index');
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

    public function destroy()
    {

    }
}

