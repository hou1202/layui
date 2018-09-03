<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;

class PermissionsController extends Controller
{
    //权限管理控制器

    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('admin.managers.permissions_index',compact('permissions'));
    }

    public function create()
    {
        $menu = Permission::get()->where('is_menu',1);
        return view('admin.managers.permissions_create',compact('menu'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|max:8',
            'route' => 'required|max:255',
            'icon' => 'required|max:50|min:2',
            'type_id' => 'required|numeric|integer'
        ],[
            'title.required' => '权限目录名称不得为空',
            'title.max' => '权限目录名称不得超过8个字',
            'route.required' => '权限目录路由不得为空',
            'route.max' => '权限目录路由格式不正确',
            'icon.required' => '权限目录图标不得为空',
            'icon.max' => '权限目录路由格式不正确',
            'icon.min' => '权限目录路由格式不正确',
            'type_id.required' => '权限所属目录不得为空',
            'type_id.numeric' => '权限所属目录格式不正确',
            'type_id.integer' => '权限所属目录格式不正确',

        ]);
        $menu = $request -> type_id == 0 ? 1 :0;
        $resource = Permission::create([
            'title' => $request -> title,
            'route' => $request -> route,
            'type_id' => $request -> type_id,
            'icon' => $request->icon,
            'is_menu' => $menu,
        ]);

        return $resource ? response()->json(['code'=>1,'msg'=>'权限目录创建成功']) : response()->json(['code'=>0,'msg'=>'权限目录创建失败']);

    }

    public function edit(Permission $permission)
    {
        $menu = Permission::get()->where('is_menu',1);
        return view('admin.managers.permissions_update',compact('permission','menu'));

    }

    public function update(Permission $permission,Request $request)
    {
        $this->validate($request,[
            'title' => 'required|max:8',
            'route' => 'required|max:255',
            'icon' => 'required|max:50|min:2',
            'type_id' => 'required|numeric|integer'
        ],[
            'title.required' => '权限目录名称不得为空',
            'title.max' => '权限目录名称不得超过8个字',
            'route.required' => '权限目录路由不得为空',
            'route.max' => '权限目录路由格式不正确',
            'icon.required' => '权限目录图标不得为空',
            'icon.max' => '权限目录路由格式不正确',
            'icon.min' => '权限目录路由格式不正确',
            'type_id.required' => '权限所属目录不得为空',
            'type_id.numeric' => '权限所属目录格式不正确',
            'type_id.integer' => '权限所属目录格式不正确',

        ]);
        $data = $request -> all();
        $data['is_menu'] = $data['type_id'] == 0 ? 1 :0;
        $resource = $permission -> update($data);
        return $resource ? response()->json(['code'=>1,'msg'=>'权限目录修改成功']) : response()->json(['code'=>0,'msg'=>'权限目录修改失败']);

    }

    public function destroy(Permission $permission)
    {
        $resource = $permission ->delete();
        return $resource ? response()->json(['code'=>1,'msg'=>'权限目录删除成功']) : response()->json(['code'=>0,'msg'=>'权限目录删除失败']);

    }
}
