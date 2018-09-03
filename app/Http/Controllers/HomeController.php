<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::table('admins')->create([
            'account'=>'admin',
            'password'=>bcrypt('111111'),
            'name'=>'admin',
            'status'=>1,
            'role'=>1,
            'remarks'=>'admin',
            'create_at'=>date('Y-m-d H:i:s'),
            'update_at'=>date('Y-m-d H:i:s'),
        ]);

    }
}
