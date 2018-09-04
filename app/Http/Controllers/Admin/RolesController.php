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
        $resource = Role::create([
            'name'=>$request->name,
            'per_id'=>implode('|',$request->per_id),
        ]);

        return $resource ? redirect()->route('roles.index') : back()->withErrors(['用户创建失败']);
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $role['per_id'] = explode("|",$role['per_id']);
        return view('admin.managers.roles_update',compact('permissions','role'));
    }

    public function update(Role$role,Request $request)
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
        $data = $request -> all();
        $data['per_id'] = implode('|',$request->per_id);
        $resource = $role->update($data);
        return $resource ? redirect()->route('roles.index') : back()->withErrors(['用户更新失败']);
    }

    public function destroy(Role $role)
    {
        $resource = $role ->delete();
        return $resource ? response()->json(['msg'=>'角色删除成功']) : response()->json(['msg'=>'角色删除失败']);
    }









}
