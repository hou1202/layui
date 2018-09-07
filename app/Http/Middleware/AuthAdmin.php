<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Permission;
use App\Models\Role;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->guard('admin')->guest()) {
           if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
           } else {
                return redirect()->guest('admin/login');
           }
        }

        /*$roles = Role::where('id',auth()->guard('admin')->User()->role_id)->first();
        $roleArr = explode('|',$roles['per_id']);
        $permissions = Permission::get()->toArray();
        //访问请求Route
        $requestRoute = $request -> url ();*/
        /*var_dump($requestRoute);
        var_dump(route($permissions[1]['route']));die;*/

        return $next($request);
    }
}
