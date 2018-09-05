<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Closure;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Admin;

class LoginsController extends Controller
{
    //登录管理控制器

    use AuthenticatesUsers;
    /**
     * 登录后重定向用户的位置
     *
     * @var string
     */
    protected $redirectTo = '/admin/main';

    protected $user;

    public function __construct(Request $request)
    {
        //已经登录用户直接进行首页
        $this->middleware(function($request,Closure $next){
            if(Auth::guard('admin')->check() == true){
                return redirect()->route('admin.main');
            }
            return $next($request);
        },['except'=>['destroy']]);

    }

    //登录页面
    public function index()
    {
        return view('admin.logins.login');
    }

    //登录处理
    public function login(Request $request)
    {
        $credentials=$this->validate($request,[
            'account'=>'required|min:5|max:50',
            'password'=>'required|min:6|max:25',
        ],[
            'account.required' => '登录帐户不正确',
            'account.min' => '登录帐户不正确',
            'account.max' => '登录帐户不正确',
            'password.required' => '登录密码不正确',
            'password.min' => '登录密码不正确',
            'password.max' => '登录密码不正确',
        ]);

        if(Auth::guard('admin')->attempt($credentials)){
            if(!Auth::guard('admin')->User()->status){
                Auth::guard('admin')->logout();
                return back()->withErrors('该用户已被禁用');
            }
            $data = [];
            $data['last_ip'] = $request -> ip();
            $data['last_at'] = date('Y-m-d H:i:s');
            //更新登录记录
            Admin::where('account',$request->account)->increment('log_count','1',$data);
            return redirect()->intended(route('admin.main',[ Auth::guard('admin')->User() ]));
        }else{
            return redirect('/admin/login');
        }
    }

    //登出
    public function destroy()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }



}
