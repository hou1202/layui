<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;

class RolesController extends Controller
{
    //角色管理控制器

    public function index()
    {
        $roles = Role::paginate(10);
        return view('admin.managers.roles_index',compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.managers.roles_create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $this -> validate($request,[
            'name' => 'required|max:15|min:2',
            'per_id' => 'required|array',
        ],[
            'name.required' => '角色组名称不得为空',
            'name.max' => '角色组名称不得大于15个字',
            'name.min' => '角色组名称不得小于2个字',
            'per_id.required' => '角色组权限不得不空',
            'per_id.array' => '角色组权限格式不正确',
        ]);
        Role::create([
            'name'=>$request->name,
            'per_id'=>implode('|',$request->per_id),
        ]);

        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        //var_dump(123);die;
        $permissions = Permission::all();
        $roles = Role::get();
        view('admin.managers.roles_update',compact('permissions','roles'));
    }








}
