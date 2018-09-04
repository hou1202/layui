<?php

namespace App\Http\Controllers\admin;

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
    public function store(Request $request)
    {
        $this -> validate($request,[
            'account'=>'required|max:25|min:5|unique:admins,account',
            'password'=>'required|min:6|max:15|confirmed',
            'name'=>'required|min:2|max:15',
            'role_id'=>'required|numeric',
            'status'=>'filled',
        ],[
            'account.required' => '管理员登录帐户不得为空' ,
            'account.min' => '管理员登录帐户在不得小于5个字符' ,
            'account.max' => '管理员登录帐户在不得大于25个字符' ,
            'account.unique' => '管理员登录帐户不得重复' ,
            'password.required' => '管理员登录密码不得为空' ,
            'password.confirmed' => '管理员登录密码两次输入不一致' ,
            'password.min' => '管理员登录密码不得小于6个字符' ,
            'password.max' => '管理员登录密码不得大于15个字符' ,
            'name.required' => '管理员真实姓名不得为空' ,
            'name.min' => '管理员真实姓名不得小于2个字符' ,
            'name.max' => '管理员真实姓名不得大于15个字符' ,
            'role_id.required' => '所属管理角色信息有误' ,
            'role_id.numeric' => '所属管理角色信息有误' ,
            'status.filled' => '管理员帐户状态信息有误' ,

        ]);
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
        $result = $this -> validate($request,[
            'account'=>'required|max:25|min:5|unique:admins,account',
            'password'=>'min:6|max:15',
            'name'=>'required|min:2|max:15',
            'role_id'=>'required|numeric',
            'status'=>'filled',
        ],[
            'account.required' => '管理员登录帐户不得为空' ,
            'account.min' => '管理员登录帐户在不得小于5个字符' ,
            'account.max' => '管理员登录帐户在不得大于25个字符' ,
            'account.unique' => '管理员登录帐户不得重复' ,
            'password.min' => '管理员登录密码不得小于6个字符' ,
            'password.max' => '管理员登录密码不得大于15个字符' ,
            'name.required' => '管理员真实姓名不得为空' ,
            'name.min' => '管理员真实姓名不得小于2个字符' ,
            'name.max' => '管理员真实姓名不得大于15个字符' ,
            'role_id.required' => '所属管理角色信息有误' ,
            'role_id.numeric' => '所属管理角色信息有误' ,
            'status.filled' => '管理员帐户状态信息有误' ,

        ]);
        $data = $request -> all();
        var_dump($result);
    }

    public function destroy(Admin $admin)
    {
        $resource = $admin -> delete();
        return $resource ? response()->json(['code'=>1,'msg'=>'管理员删除成功']) : response()->json(['code'=>0,'msg'=>'管理员删除失败']);
    }

    //数据验证
    protected function dataVali($data){
        return $this -> validate($data,[
            'account'=>'required|digits_between:5,50|unique:admins,account',
            'password'=>'required|digits_between:6,25|confirmed',
            'name'=>'required|digits_between:2,15',
            'role_id'=>'required|numeric',
            'status'=>'filled',
        ],[
            'account.required' => '管理员登录帐户不得为空' ,
            'account.digits_between' => '管理员登录帐户在5-25个字符' ,
            'account.unique' => '管理员登录帐户不得重复' ,
            'password.required' => '管理员登录密码不得为空' ,
            'password.digits_between' => '管理员登录密码在6个字符' ,
            'password.confirmed' => '管理员登录密码两次输入不一致' ,
            'name.required' => '管理员真实姓名不得为空' ,
            'name.digits_between' => '管理员真实姓名不得在2-15个字符' ,
            'role_id.required' => '所属管理角色信息有误' ,
            'role_id.numeric' => '所属管理角色信息有误' ,
            'status.filled' => '管理员帐户状态信息有误' ,

        ]);
    }





}

